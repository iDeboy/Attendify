<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\DbContext;
use Abstractions\Renderer;
use DateTime;
use DateTimeZone;
use Exception;

class ProfesorController {

    public function __construct(
        private readonly Renderer $renderer,
        private readonly DbContext $db
    ) {
    }

    public function principal() {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $profesor = $_SESSION['Usuario'];
        $solicitudes = $this->get_solicitudes($profesor);

        echo $this->renderer->view(
            'Pages/ProfesorPrincipalPage.php',
            ['Profesor' => $profesor, 'Solicitudes' => $solicitudes],
            layout: 'Layouts/ProfesorLayout.php'
        );
    }

    public function grupos_creados() {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $profesor = $_SESSION['Usuario'];
        $grupos = $this->get_grupos($profesor);

        echo $this->renderer->view(
            'Pages/ProfesorGruposCreaPage.php',
            ['Profesor' => $profesor, 'Grupos' => $grupos],
            layout: 'Layouts/ProfesorLayout.php'
        );
    }

    public function vista_crear_grupo() {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $profesor = $_SESSION['Usuario'];
        $materias = $this->get_materias();

        echo $this->renderer->view(
            'Pages/ProfesorCrearPage.php',
            ['Profesor' => $profesor, 'Materias' => $materias],
            layout: 'Layouts/ProfesorLayout.php',
            scripts: ['assets/js/profesorCrear.js']
        );
    }

    public function grupo(string $grupoId) {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $profesor = $_SESSION['Usuario'];
        $grupo = $this->get_grupo($profesor->Id, $grupoId);

        if ($grupo === null) { // No encontrado
            echo $this->renderer->view("Pages/NotFound.php", [
                'Error' => 'Recurso no encontrado',
                'Mensaje' => 'El grupo solicitado no existe.',
                'Regresar' => BASE_SITE . '/profesor/grupos'
            ]);
            return;
        }

        $alumnos = $this->get_alumnos($grupoId);
        $solicitudes = $this->get_solicitudes_pendientes($grupoId);
        $clases = $this->get_clases($grupoId);

        echo $this->renderer->view(
            'Pages/ProfesorGrupoPage.php',
            [
                'Profesor' => $profesor,
                'Grupo' => $grupo,
                'Alumnos' => $alumnos,
                'Solicitudes' => $solicitudes,
                'Clases' => $clases
            ],
            layout: 'Layouts/ProfesorLayout.php',
            scripts: ['assets/js/profesorGrupo.js', 'assets/js/grafica.js']
        );
    }

    public function solicitud() {

        if (!is_user_auth('Logeado')) {
            echo json_encode(['valido' => false, 'error' =>  'No estas logeado.']);
            return;
        }

        $body = json_decode(file_get_contents('php://input'), true);

        $accion = $body['accion'];

        $solicitudId = trim($body['solicitudId']);
        $regex = "/^\d+$/";
        if (!preg_match($regex, $solicitudId)) {
            echo json_encode(['valido' => false, 'error' =>  'La solicitud es inválida.']);
            return;
        }

        if ($accion === 0) {
            $accion = 'Rechazado';
        } elseif ($accion === 1) {
            $accion = 'Aceptado';
        } else {
            echo json_encode(['valido' => false, 'error' => 'Hubo un problema interno. Por favor, intentalo más tarde.']);
            return;
        }

        if (!$this->db->execute("UPDATE InscripcionGrupo SET Estado = '$accion' WHERE Id = ?", "i", [$solicitudId])) {
            echo json_encode(['valido' => false, 'error' => 'Hubo un problema interno. Por favor, intentalo más tarde.']);
            return;
        }

        echo json_encode(['valido' => true]);
    }

    public function agregar_clase(string $grupoId) {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $profesor = $_SESSION['Usuario'];

        $grupo = $this->get_grupo($profesor->Id, $grupoId);

        if ($grupo === null) { // No encontrado
            echo $this->renderer->view("Pages/NotFound.php", [
                'Error' => 'Recurso no encontrado',
                'Mensaje' => 'El grupo solicitado no existe.',
                'Regresar' => BASE_SITE . '/profesor/grupos'
            ]);
            return;
        }

        $solicitudes = $this->get_solicitudes_pendientes($grupoId);

        echo $this->renderer->view(
            'Pages/ProfesorAgregarListaPage.php',
            [
                'Profesor' => $profesor,
                'Grupo' => $grupo,
                'Solicitudes' => $solicitudes
            ],
            layout: 'Layouts/ProfesorLayout.php',
            scripts: ['assets/js/profesorGrupo.js', 'assets/js/crearClase.js']
        );
    }

    public function vista_clase(string $claseId) {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $profesor = $_SESSION['Usuario'];
        $profesor = $_SESSION['Usuario'];

        $clase = $this->get_clase($claseId);
        $grupo = $this->get_grupo($profesor->Id, $clase->IdGrupo);

        if ($grupo === null) { // No encontrado
            echo $this->renderer->view("Pages/NotFound.php", [
                'Error' => 'Recurso no encontrado',
                'Mensaje' => 'El grupo solicitado no existe.',
                'Regresar' => BASE_SITE . '/profesor/grupos'
            ]);
            return;
        }

        $solicitudes = $this->get_solicitudes_pendientes($clase->IdGrupo);
        $asistencias = $this->get_asistencias($clase->Id);

        echo $this->renderer->view(
            'Pages/ProfesorVistaListaPage.php',
            [
                'Profesor' => $profesor,
                'Clase' => $clase,
                'Grupo' => $grupo,
                'Solicitudes' => $solicitudes,
                'Asistencias' => $asistencias
            ],
            layout: 'Layouts/ProfesorLayout.php',
            scripts: ['assets/js/profesorGrupo.js']
        );
    }

    public function crear_clase() {

        if (!is_user_auth('Logeado')) {
            echo json_encode(['valido' => false, 'error' =>  'No estas logeado.']);
            return;
        }

        $body = json_decode(file_get_contents('php://input'), true);

        $grupoId = strtoupper(trim($body['grupoId']));
        $regex = "/^[0-9][A-Z][0-9][A-Z]$/";
        if (!preg_match($regex, $grupoId)) {
            echo json_encode(['valido' => false, 'error' => 'El grupo no es válido.']);
            return;
        }

        $temaClase = htmlspecialchars(trim($body['temaClase']));
        if (empty($temaClase) || strlen($temaClase) > 255) {
            echo json_encode(['valido' => false, 'error' => 'El tema es muy largo o no tiene contenido.']);
            return;
        }

        $fechaClase = trim($body['fechaClase']);
        $horaClase = trim($body['horaClase']);

        $fecha = "$fechaClase $horaClase";

        try {
            $dateTime = new DateTime($fecha);
        } catch (Exception $e) {
            echo json_encode(['valido' => false, 'error' => 'La fecha o la hora tienen un formato inválido.']);
            return;
        }

        $now = new DateTime();
        $now = new DateTime($now->format('Y-m-d H:i'));

        if ($dateTime < $now) {
            echo json_encode(['valido' => false, 'error' => 'La fecha no puede ser un momento anterior.']);
            return;
        }

        $sql = "INSERT INTO Clase(IdGrupo, FechaInicio, Tema) VALUES (?,?,?);";
        if (!$this->db->execute($sql, "sss", [$grupoId, $fecha, $temaClase])) {
            echo json_encode(['valido' => false, 'error' => 'Hubo un problema interno. Por favor, intentalo más tarde.']);
            return;
        }

        echo json_encode(['valido' => true]);
    }

    public function crear_grupo() {

        if (!is_user_auth('Logeado')) {
            echo json_encode(['valido' => false, 'error' =>  'No estas logeado.']);
            return;
        }

        $profesor = $_SESSION['Usuario'];

        $body = json_decode(file_get_contents('php://input'), true);

        $claveGrupo = strtoupper(trim($body['claveGrupo']));
        $regex = "/^[A-Z]$/";
        if (!preg_match($regex, $claveGrupo)) {
            echo json_encode(['valido' => false, 'error' =>  'La clave no es válida.']);
            return;
        }

        $horasSemanales = trim($body['horasSemanales']);
        $regex = "/^\d+$/";
        if (!preg_match($regex, $horasSemanales)) {
            echo json_encode(['valido' => false, 'error' =>  'Las horas semanales tienen un valor inválido.']);
            return;
        }

        $materiaId = strtoupper(trim($body['materiaId']));
        $regex = "/^[0-9][A-Z][0-9]$/";
        if (!preg_match($regex, $materiaId)) {
            echo json_encode(['valido' => false, 'error' =>  'Hubo un error con la materia.']);
            return;
        }

        $horasSemanales = intval($horasSemanales);

        if ($horasSemanales < 1) {
            echo json_encode(['valido' => false, 'error' =>  'Las horas semanales tienen un valor inválido.']);
            return;
        }

        $sql = "SELECT * FROM Grupo WHERE RfcProfesor = ? AND IdMateria = ? AND Clave = ?;";
        $result = $this->db->query($sql, [$profesor->Id, $materiaId, $claveGrupo]);
        if ($result && !empty($result)) {
            echo json_encode(['valido' => false, 'error' => 'Ya existe este grupo. Por favor, intentalo de nuevo.']);
            return;
        }

        $sql = "INSERT INTO Grupo(RfcProfesor, IdMateria, Clave, HorasSemanales) VALUES (?,?,?,?);";
        if (!$this->db->execute($sql, "sssi", [$profesor->Id, $materiaId, $claveGrupo, $horasSemanales])) {
            echo json_encode(['valido' => false, 'error' => 'Hubo un problema interno. Por favor, intentalo más tarde.']);
            return;
        }

        echo json_encode(['valido' => true]);
    }

    public function crear_materia() {

        if (!is_user_auth('Logeado')) {
            echo json_encode(['valido' => false, 'error' =>  'No estas logeado.']);
            return;
        }

        $body = json_decode(file_get_contents('php://input'), true);

        $codigoMateria = trim(strtoupper($body['codigoMateria']));
        $regex = "/^[0-9][A-Z][0-9]$/";
        if (!preg_match($regex, $codigoMateria)) {
            echo json_encode(['valido' => false, 'error' =>  'El código de la materia tiene un formato inválido.']);
            return;
        }

        $nombreMateria = trim($body['nombreMateria']);
        $regex = "/^[0-9A-Za-zÑÁÉÍÓÚñáéíóú ]{3,50}$/";
        if (!preg_match($regex, $nombreMateria)) {
            echo json_encode(['valido' => false, 'error' =>  'El nombre de la materia es inválido.']);
            return;
        }

        if (!$this->db->execute("INSERT INTO Materia(Id, Nombre) VALUES (?,?);", "ss", [$codigoMateria, $nombreMateria])) {
            echo json_encode(['valido' => false, 'error' =>  'Hubo un problema interno. Por favor, intentalo más tarde.']);
            return;
        }

        echo json_encode(['valido' => true]);
    }

    public function grafica() {

        if (!is_user_auth('Logeado')) {
            echo json_encode(['valido' => false, 'error' =>  'No estas logeado.']);
            return;
        }

        $body = json_decode(file_get_contents('php://input'), true);

        $grupoId = strtoupper(trim($body['grupoId']));
        $regex = "/^[0-9][A-Z][0-9][A-Z]$/";
        if (!preg_match($regex, $grupoId)) {
            echo json_encode(['valido' => false, 'error' => 'El grupo no es válido.']);
            return;
        }

        $filtro = trim($body['filtro']);
        $regex = "/^1|2$/";
        if (!preg_match($regex, $filtro)) {
            echo json_encode(['valido' => false, 'error' => 'Hubo un problema interno. Por favor, intentalo más tarde.']);
            return;
        }
        $filtro = intval($filtro);
        if ($filtro === 1) { // Semanal

            $datos = [
                'Lunes' => 0,
                'Martes' => 0,
                'Miércoles' => 0,
                'Jueves' => 0,
                'Viernes' => 0,
                'Sábado' => 0,
            ];

            $sql = "SELECT 
                    CASE 
                        WHEN DAYOFWEEK(Fecha) = 2 THEN 'Lunes'
                        WHEN DAYOFWEEK(Fecha) = 3 THEN 'Martes'
                        WHEN DAYOFWEEK(Fecha) = 4 THEN 'Miércoles'
                        WHEN DAYOFWEEK(Fecha) = 5 THEN 'Jueves'
                        WHEN DAYOFWEEK(Fecha) = 6 THEN 'Viernes'
                        WHEN DAYOFWEEK(Fecha) = 7 THEN 'Sábado'
                    END AS Metrica,
                    COUNT(*) AS CantidadAsistencias
                FROM Asistencia A
                INNER JOIN Clase C ON A.IdClase = C.Id
                WHERE C.IdGrupo = ? AND DAYOFWEEK(Fecha) != 1
                GROUP BY DAYOFWEEK(Fecha)
                ORDER BY DAYOFWEEK(Fecha);";
        } else {
            $datos = [
                'Enero' => 0,
                'Febrero' => 0,
                'Marzo' => 0,
                'Abril' => 0,
                'Mayo' => 0,
                'Junio' => 0,
                'Julio' => 0,
                'Agosto' => 0,
                'Septiembre' => 0,
                'Octubre' => 0,
                'Noviembre' => 0,
                'Diciembre' => 0,
            ];
            $sql = "SELECT 
                        CASE 
                            WHEN MONTH(Fecha) = 1 THEN 'Enero'
                            WHEN MONTH(Fecha) = 2 THEN 'Febrero'
                            WHEN MONTH(Fecha) = 3 THEN 'Marzo'
                            WHEN MONTH(Fecha) = 4 THEN 'Abril'
                            WHEN MONTH(Fecha) = 5 THEN 'Mayo'
                            WHEN MONTH(Fecha) = 6 THEN 'Junio'
                            WHEN MONTH(Fecha) = 7 THEN 'Julio'
                            WHEN MONTH(Fecha) = 8 THEN 'Agosto'
                            WHEN MONTH(Fecha) = 9 THEN 'Septiembre'
                            WHEN MONTH(Fecha) = 10 THEN 'Octubre'
                            WHEN MONTH(Fecha) = 11 THEN 'Noviembre'
                            WHEN MONTH(Fecha) = 12 THEN 'Diciembre'
                        END AS Metrica,
                        COUNT(*) AS CantidadAsistencias
                    FROM Asistencia A
                    INNER JOIN Clase C ON A.IdClase = C.Id
                    WHERE C.IdGrupo = ?
                    GROUP BY MONTH(Fecha)
                    ORDER BY MONTH(Fecha);";
        }

        $results = $this->db->query($sql, [$grupoId]);

        if (!$results) {
            echo json_encode(['valido' => true, 'Data' => $datos]);
            return;
        }

        foreach ($results as $key => $result) {
            $datos[$result->Metrica] = $result->CantidadAsistencias;
        }

        echo json_encode(['valido' => true, 'Data' => $datos]);
    }

    private function get_grupo(string $profesorRfc, string $grupoId) {

        $sql =
            "SELECT 
                g.Id AS IdGrupo, 
                m.Nombre AS NombreMateria 
            FROM Grupo g
            JOIN Materia m ON g.IdMateria = m.Id 
            WHERE g.RfcProfesor = ? AND g.Id = ?;";
        $result = $this->db->query($sql, [$profesorRfc, $grupoId]);

        if (!$result || empty($result)) return null;

        return $result[0];
    }

    private function get_alumnos(string $grupoId) {
        $sql =
            "SELECT 
                a.Nombre AS Nombre,
                a.Apellidos AS Apellidos,
                COUNT(asist.Id) AS Asistencias
            FROM InscripcionGrupo ig
            INNER JOIN Alumno a ON ig.IdAlumno = a.NoControl
            INNER JOIN Clase AS c ON ig.IdGrupo = c.IdGrupo
            LEFT JOIN Asistencia AS asist ON c.Id = asist.IdClase AND asist.IdAlumno = a.NoControl
            WHERE ig.IdGrupo = ? AND ig.Estado = 'Aceptado'
            GROUP BY a.Nombre, a.Apellidos, a.NoControl
            HAVING COUNT(a.NoControl) > 0
            ORDER BY a.Apellidos ASC, a.Nombre ASC, a.NoControl ASC;";

        $result = $this->db->query($sql, [$grupoId]);

        if (!$result) return [];

        return $result;
    }

    private function get_solicitudes_pendientes(string $grupoId) {

        $sql =
            "SELECT 
                ig.Id AS Id,
                a.Nombre AS NombreAlumno,
                a.Apellidos AS ApellidosAlumno
            FROM InscripcionGrupo ig
            JOIN Alumno a ON ig.IdAlumno = a.NoControl
            WHERE ig.IdGrupo = ? AND ig.Estado = 'Pendiente'
            ORDER BY ig.Fecha DESC;";

        $result = $this->db->query($sql, [$grupoId]);

        if (!$result) return [];

        return $result;
    }

    private function get_clases(string $grupoId) {

        $sql =
            "SELECT 
                Id,
                DATE_FORMAT(FechaInicio, '%d-%m-%Y | %H:%i hrs') AS Fecha,
                Tema
            FROM Clase
            WHERE IdGrupo = ?
            ORDER BY FechaInicio ASC;";

        $result = $this->db->query($sql, [$grupoId]);

        if (!$result) return [];

        return $result;
    }

    private function get_clase(string $claseId) {
        $sql =
            "SELECT 
                Id,
                IdGrupo,
                DATE_FORMAT(FechaInicio, '%d-%m-%Y | %H:%i hrs') AS Fecha,
                Tema
            FROM Clase 
            WHERE Id = ?;";
        $result = $this->db->query($sql, [$claseId]);
        if (!$result || empty($result)) return [];
        return $result[0];
    }

    private function get_solicitudes($profesor): array {

        $sql =
            "SELECT 
                g.Id AS IdGrupo,
                m.Nombre AS NombreMateria,
                COUNT(ig.Id) AS NumeroInscripciones
            FROM Grupo g 
            JOIN Materia m ON g.IdMateria = m.Id
            JOIN InscripcionGrupo ig ON ig.IdGrupo = g.Id
            WHERE g.RfcProfesor = ? AND ig.Estado = 'Pendiente'
            GROUP BY g.Id, m.Nombre
            ORDER BY MAX(ig.Fecha) DESC;";

        $result = $this->db->query($sql, [$profesor->Id]);

        if (!$result) return [];

        return $result;
    }

    private function get_grupos($profesor): array {

        $sql =
            "SELECT 
                g.Id AS IdGrupo,
                m.Nombre AS NombreMateria,
                COUNT(ig.IdAlumno) AS CantidadAlumnos
            FROM Grupo g
            JOIN Materia m ON g.IdMateria = m.Id
            LEFT JOIN InscripcionGrupo ig ON g.Id = ig.IdGrupo AND ig.Estado = 'Aceptado'
            WHERE g.RfcProfesor = ?
            GROUP BY g.Id, m.Nombre
            ORDER BY g.Id;";

        $result = $this->db->query($sql, [$profesor->Id]);

        if (!$result) return [];

        return $result;
    }

    private function get_materias(): array {

        $result = $this->db->query("SELECT * FROM Materia");

        if (!$result) return [];

        return $result;
    }

    private function get_asistencias(int $claseId) {
        $sql =
            "SELECT 
                al.Nombre,
                al.Apellidos,
                a.Ip
            FROM Asistencia a
            JOIN Alumno al ON a.IdAlumno = al.NoControl
            WHERE a.IdClase = ?
            ORDER BY a.Fecha ASC;";

        $result = $this->db->query($sql, [$claseId]);

        if (!$result) return [];

        return $result;
    }
}
