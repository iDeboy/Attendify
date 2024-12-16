<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\DbContext;
use Abstractions\Renderer;

class AlumnoController {

    public function __construct(
        private readonly Renderer $renderer,
        private readonly DbContext $db
    ) {
    }

    public function principal() {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $alumno = $_SESSION['Usuario'];
        $clases = $this->get_clases_hoy($alumno->Id);
        $solicitudes = $this->get_solicitudes($alumno->Id);

        echo $this->renderer->view(
            'Pages/AlumnoPrincipalPage.php',
            ['Alumno' => $alumno, 'Clases' => $clases, 'Solicitudes' => $solicitudes],
            layout: 'Layouts/AlumnoLayout.php'
        );
    }

    public function grupos_disponibles() {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $alumno = $_SESSION['Usuario'];

        $filtro = null;
        if (isset($_GET['materia'])) {
            $filtro = htmlspecialchars($_GET['materia']);

            if (strlen(trim($filtro)) === 0) {
                header('Location: ' . BASE_SITE . "/alumno/grupos-disponibles");
                return;
            }
        }

        $grupos = $this->get_grupos_disponibles($alumno->Id, $filtro);

        echo $this->renderer->view(
            'Pages/AlumnoGruposDispPage.php',
            [
                'Alumno' => $alumno,
                'Grupos' => $grupos,
                'Filtro' => $filtro
            ],
            layout: 'Layouts/AlumnoLayout.php',
            scripts: ['assets/js/alumnoGruposDispPage.js']
        );
    }

    public function inscribirse() {

        if (!is_user_auth('Logeado')) {
            echo json_encode(['valido' => false, 'error' =>  'No estas logeado.']);
            return;
        }

        $alumno = $_SESSION['Usuario'];
        $body = json_decode(file_get_contents('php://input'), true);

        $grupoId = strtoupper(trim($body['grupoId']));
        $regex = "/^[0-9][A-Z][0-9][A-Z]$/";
        if (!preg_match($regex, $grupoId)) {
            echo json_encode(['valido' => false, 'error' => 'El grupo no es válido.']);
            return;
        }

        if (!$this->db->execute(
            "INSERT INTO InscripcionGrupo(IdGrupo, IdAlumno) VALUES(?,?);",
            "ss",
            [$grupoId, $alumno->Id]
        )) {
            echo json_encode(['valido' => false, 'error' => 'Hubo un problema interno. Por favor, intentalo más tarde.']);
            return;
        }

        echo json_encode(['valido' => true]);
    }

    public function grupos_inscrito() {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $alumno = $_SESSION['Usuario'];

        $filtro = null;
        if (isset($_GET['materia'])) {
            $filtro = htmlspecialchars($_GET['materia']);

            if (strlen(trim($filtro)) === 0) {
                header('Location: ' . BASE_SITE . "/alumno/grupos");
                return;
            }
        }

        $grupos = $this->get_grupos($alumno->Id, $filtro);

        echo $this->renderer->view(
            'Pages/AlumnoGruposInsPage.php',
            [
                'Alumno' => $alumno,
                'Grupos' => $grupos,
                'Filtro' => $filtro
            ],
            layout: 'Layouts/AlumnoLayout.php'
        );
    }

    public function grupo(string $grupoId) {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $alumno = $_SESSION['Usuario'];
        $grupo = $this->get_grupo($alumno->Id, $grupoId);

        if ($grupo === null) { // No encontrado
            echo $this->renderer->view("Pages/NotFound.php", [
                'Error' => 'Recurso no encontrado',
                'Mensaje' => 'El grupo solicitado no existe.',
                'Regresar' => BASE_SITE . '/alumno/grupos'
            ]);
            return;
        }

        $clases = $this->get_clases($alumno->Id, $grupo->Id);
        $clasesVistas = $this->get_clases_vistas($alumno->Id, $grupo->Id);

        echo $this->renderer->view(
            'Pages/AlumnoGrupoPage.php',
            [
                'Alumno' => $alumno,
                'Grupo' => $grupo,
                'Clases' => $clases,
                'ClasesVistas' => $clasesVistas
            ],
            layout: 'Layouts/AlumnoLayout.php',
            scripts: ['assets/js/alumnoGrupo.js']
        );
    }

    public function asistencia() {

        if (!is_user_auth('Logeado')) {
            echo json_encode(['valido' => false, 'error' =>  'No estas logeado.']);
            return;
        }

        $alumno = $_SESSION['Usuario'];
        $body = json_decode(file_get_contents('php://input'), true);

        $claseId = strtoupper(trim($body['claseId']));
        $regex = "/^\d+$/";
        if (!preg_match($regex, $claseId)) {
            echo json_encode(['valido' => false, 'error' => 'La clase no es válida.']);
            return;
        }
        # Se muestra presente aunque ya haya asistencia
        $sql = "SELECT 
                    CASE 
                        WHEN TIMESTAMPDIFF(MINUTE, c.FechaInicio, NOW()) <= 10 AND a.IdAlumno IS NULL THEN 1
                        WHEN TIMESTAMPDIFF(MINUTE, c.FechaInicio, NOW()) > 10 THEN 0
                        WHEN a.IdAlumno IS NOT NULL THEN 0
                    END AS PuedePresente
                FROM Clase AS c
                LEFT JOIN Asistencia AS a ON a.IdClase = c.Id AND a.IdAlumno = ?
                WHERE c.Id = ? AND c.FechaInicio < NOW();";

        $result = $this->db->query($sql, [$alumno->Id, $claseId]);
        if (!$result) {
            echo json_encode(['valido' => false, 'error' => 'Hubo un problema interno. Por favor, intentalo más tarde.']);
            return;
        }

        $result = $result[0];
        if ($result->PuedePresente === 0) {
            echo json_encode(['valido' => false, 'error' => 'No puedes poner asistencia.']);
            return;
        }

        $ip = $_SERVER['REMOTE_ADDR'];

        $sql = "INSERT INTO Asistencia (IdClase,IdAlumno,Ip) VALUES(?,?,?);";
        if (!$this->db->execute($sql, "iss", [$claseId, $alumno->Id, $ip])) {
            echo json_encode(['valido' => false, 'error' => 'Hubo un problema interno. Por favor, intentalo más tarde.']);
            return;
        }

        echo json_encode(['valido' => true]);
    }


    private function get_clases_hoy(string $alumnoId): array {

        $result = $this->db->query(
            "SELECT 
                g.Id AS IdGrupo,
                m.Nombre AS NombreMateria,
                c.Tema AS Tema,
                DATE_FORMAT(c.FechaInicio, '%d-%m-%Y | %H:%i hrs') AS Fecha
            FROM Clase AS c
            INNER JOIN Grupo AS g ON c.IdGrupo = g.Id
            INNER JOIN Materia AS m ON g.IdMateria = m.Id
            INNER JOIN InscripcionGrupo AS ig ON g.Id = ig.IdGrupo
            INNER JOIN Alumno AS a ON ig.IdAlumno = a.NoControl
            LEFT JOIN Asistencia As asist ON c.Id = asist.IdClase AND a.NoControl = asist.IdAlumno
            WHERE a.NoControl = ? AND DATE(c.FechaInicio) = CURDATE() AND asist.Id IS NULL;",
            [$alumnoId]
        );

        if (!$result) return [];

        return $result;
    }

    private function get_solicitudes(string $alumnoId): array {

        $result = $this->db->query(
            "SELECT 
                Grupo.Id AS IdGrupo,
                Materia.Nombre AS NombreMateria,
                InscripcionGrupo.Estado AS Estado
            FROM InscripcionGrupo
            INNER JOIN Grupo ON InscripcionGrupo.IdGrupo = Grupo.Id
            INNER JOIN Materia ON Grupo.IdMateria = Materia.Id
            WHERE InscripcionGrupo.IdAlumno = ?;",
            [$alumnoId]
        );

        if (!$result) return [];

        return $result;
    }

    private function get_grupos_disponibles(string $alumnoId, ?string $materiaNombre): array {

        $condicion = $materiaNombre === null ? '' : "AND LOWER(m.Nombre) LIKE '%" . strtolower($this->db->escape_string($materiaNombre)) . "%'";

        $result = $this->db->query(
            "SELECT 
                g.Id AS Id,
                m.Nombre AS NombreMateria,
                p.Nombre AS NombreProfesor, 
                p.Apellidos AS ApellidosProfesor
            FROM Grupo AS g
            INNER JOIN Materia AS m ON g.IdMateria = m.Id
            INNER JOIN Profesor AS p ON g.RfcProfesor = p.Rfc
            LEFT JOIN InscripcionGrupo AS ig ON g.Id = ig.IdGrupo AND ig.IdAlumno = ?
            WHERE ig.IdAlumno IS NULL $condicion;",
            [$alumnoId]
        );

        if (!$result) return [];

        return $result;
    }

    private function get_grupos(string $alumnoId, ?string $materiaNombre): array {

        $condicion = $materiaNombre === null ? '' : "AND LOWER(m.Nombre) LIKE '%" . strtolower($this->db->escape_string($materiaNombre)) . "%'";

        $result = $this->db->query(
            "SELECT 
                g.Id AS Id,
                m.Nombre AS NombreMateria,
                p.Nombre AS NombreProfesor,
                p.Apellidos AS ApellidosProfesor
            FROM InscripcionGrupo AS ig
            INNER JOIN Grupo AS g ON ig.IdGrupo = g.Id
            INNER JOIN Materia AS m ON g.IdMateria = m.Id
            INNER JOIN Profesor AS p ON g.RfcProfesor = p.Rfc
            WHERE ig.IdAlumno = ? AND ig.Estado = 'Aceptado' $condicion;",
            [$alumnoId]
        );

        if (!$result) return [];

        return $result;
    }

    private function get_clases(string $alumnoId, string $grupoId): array {

        $result = $this->db->query(
            "SELECT
                c.Id, 
                DATE_FORMAT(c.FechaInicio, '%d-%m-%Y | %H:%i hrs') AS Fecha,
                c.Tema AS Tema,
                CASE 
                    WHEN c.FechaInicio < NOW() AND TIMESTAMPDIFF(MINUTE, NOW(), c.FechaInicio) <= 10 THEN 'Pendiente'
                    WHEN c.FechaInicio > NOW() THEN 'Próxima'
                    ELSE 'Ausente'
                END AS Estado
            FROM Clase AS c
            INNER JOIN Grupo AS g ON c.IdGrupo = g.Id
            INNER JOIN InscripcionGrupo AS ig ON ig.IdGrupo = g.Id
            LEFT JOIN Asistencia AS a ON a.IdClase = c.Id AND a.IdAlumno = ig.IdAlumno
            WHERE a.IdAlumno IS NULL AND ig.IdAlumno = ? AND g.Id = ? AND (c.FechaInicio > NOW() OR TIMESTAMPDIFF(MINUTE, c.FechaInicio, NOW()) <= 10)
            ORDER BY c.FechaInicio;",
            [$alumnoId, $grupoId]
        );

        if (!$result) return [];

        return $result;
    }

    private function get_clases_vistas(string $alumnoId, string $grupoId): array {

        $result = $this->db->query(
            "SELECT 
                DATE_FORMAT(c.FechaInicio, '%d-%m-%Y | %H:%i hrs') AS Fecha,
                c.Tema AS Tema,
                CASE 
                    WHEN a.IdAlumno IS NOT NULL THEN 'Presente'
                    WHEN TIMESTAMPDIFF(MINUTE, c.FechaInicio, NOW()) > 10 THEN 'Ausente'
                    ELSE 'Ausente'
                END AS Estado
            FROM Clase AS c
            INNER JOIN Grupo AS g ON c.IdGrupo = g.Id
            INNER JOIN InscripcionGrupo AS ig ON ig.IdGrupo = g.Id
            LEFT JOIN Asistencia AS a ON a.IdClase = c.Id AND a.IdAlumno = ig.IdAlumno
            WHERE ig.IdAlumno = ? AND g.Id = ?
                AND c.FechaInicio < NOW() AND TIMESTAMPDIFF(MINUTE, c.FechaInicio, NOW()) > 10 OR a.IdAlumno IS NOT NULL
            ORDER BY c.FechaInicio DESC;",
            [$alumnoId, $grupoId]
        );

        if (!$result) return [];

        return $result;
    }

    private function get_grupo(string $alumnoId, string $grupoId): ?object {

        $result = $this->db->query(
            "SELECT
                g.Id AS Id,
                m.Nombre AS NombreMateria,
                p.Nombre AS NombreProfesor, 
                p.Apellidos AS ApellidosProfesor
            FROM Grupo AS g
            INNER JOIN Materia AS m ON g.IdMateria = m.Id
            INNER JOIN Profesor AS p ON g.RfcProfesor = p.Rfc
            INNER JOIN InscripcionGrupo AS ig ON g.Id = ig.IdGrupo
            WHERE g.Id = ? AND ig.IdAlumno = ? AND ig.Estado = 'Aceptado';",
            [$grupoId, $alumnoId]
        );

        if ($result === false || empty($result)) return null;

        return $result[0];
    }
}
