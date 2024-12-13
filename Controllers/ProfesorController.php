<?php

declare(strict_types=1);

namespace Controllers;

use Abstractions\DbContext;
use Abstractions\Renderer;

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
            echo "No existe el grupo";
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
            scripts: ['assets/js/profesorGrupo.js']
        );
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

    private function get_grupo(string $profesorRfc, string $grupoId) {

        $sql =
            "SELECT g.Id AS IdGrupo, m.Nombre AS NombreMateria FROM Grupo g
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
                a.Apellidos AS Apellidos
            FROM InscripcionGrupo ig
            JOIN Alumno a ON ig.IdAlumno = a.NoControl
            WHERE ig.IdGrupo = ? AND ig.Estado = 'Aceptado'
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
                Id AS Id,
                DATE_FORMAT(FechaInicio, '%d-%m-%Y | %H:%i hrs') AS Fecha,
                Tema AS Tema
            FROM Clase
            WHERE IdGrupo = ?
            ORDER BY FechaInicio ASC;";

        $result = $this->db->query($sql, [$grupoId]);

        if (!$result) return [];

        return $result;
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

    public function vista_lista() {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $profesor = $_SESSION['Usuario'];

        echo $this->renderer->view(
            'Pages/ProfesorVistaListaPage.php',
            ['Profesor' => $profesor],
            layout: 'Layouts/ProfesorLayout.php'
        );
    }

    public function agregar_lista() {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $profesor = $_SESSION['Usuario'];

        echo $this->renderer->view(
            'Pages/ProfesorAgregarListaPage.php',
            ['Profesor' => $profesor],
            layout: 'Layouts/ProfesorLayout.php'
        );
    }
}
