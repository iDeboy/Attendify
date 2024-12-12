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

    public function vista_lista() {

        if (needs_login('Logeado', 'login')) return;

        $profesor = $_SESSION['Usuario'];

        echo $this->renderer->view(
            'Pages/ProfesorVistaListaPage.php',
            ['Profesor' => $profesor],
            layout: 'Layouts/ProfesorLayout.php'
        );

    }

    public function agregar_lista() {

        if (needs_login('Logeado', 'login')) return;

        $profesor = $_SESSION['Usuario'];

        echo $this->renderer->view(
            'Pages/ProfesorAgregarListaPage.php',
            ['Profesor' => $profesor],
            layout: 'Layouts/ProfesorLayout.php'
        );
    }

    public function principal() {

        if (needs_login('Logeado', 'login')) return;

        $profesor = $_SESSION['Usuario'];
        $solicitudes = $this->get_solicitudes($profesor);

        echo $this->renderer->view(
            'Pages/ProfesorPrincipalPage.php',
            ['Profesor' => $profesor, 'Solicitudes' => $solicitudes],
            layout: 'Layouts/ProfesorLayout.php'
        );
    }

    public function grupos_creados() {

        if (needs_login('Logeado', 'login')) return;

        $profesor = $_SESSION['Usuario'];
        $grupos = $this->get_grupos($profesor);

        echo $this->renderer->view(
            'Pages/ProfesorGruposCreaPage.php',
            ['Profesor' => $profesor, 'Grupos' => $grupos],
            layout: 'Layouts/ProfesorLayout.php'
        );
    }

    public function vista_crear_grupo() {

        if (needs_login('Logeado', 'login')) return;

        $profesor = $_SESSION['Usuario'];
        $materias = $this->get_materias();

        echo $this->renderer->view(
            'Pages/ProfesorCrearPage.php',
            ['Profesor' => $profesor, 'Materias' => $materias],
            layout: 'Layouts/ProfesorLayout.php',
            scripts: ['assets/js/profesorCrear.js']
        );
    }

    public function crear_grupo() {
        $body = json_decode(file_get_contents('php://input'), true);

        $horasSemanales = $body['horasSemanales'];
        $materiaId = $body['materiaId'];
        $nombreGrupo = $body['nombreGrupo'];

        if (empty($horasSemanales) || empty($nombreGrupo) || $materiaId === 0) {
            echo json_encode(['valido' => false]);
            return;
        }

        $horasSemanales = intval($horasSemanales);

        if (!$this->db->execute("INSERT INTO Grupo(nombreGrupo,horas_semanales) VALUES (?,?);", "si", [$nombreGrupo, $horasSemanales])) {
            echo json_encode(['valido' => false]);
            return;
        }

        echo json_encode(['valido' => false]);
    }

    public function crear_materia() {

        $body = json_decode(file_get_contents('php://input'), true);

        $nombreMateria = htmlspecialchars($body['nombreMateria']);
        $codigoMateria = htmlspecialchars($body['codigoMateria']);

        if (empty($nombreMateria) || strlen($nombreMateria) > 100) {
            echo json_encode(['valido' => false]);
            return;
        }

        if (empty($codigoMateria) || strlen($codigoMateria) > 20) {
            echo json_encode(['valido' => false]);
            return;
        }

        if (!$this->db->execute("INSERT INTO Materia(nombreMateria, codigoMateria) VALUES (?,?);", "ss", [$nombreMateria, $codigoMateria])) {
            echo json_encode(['valido' => false]);
            return;
        }

        echo json_encode(['valido' => true]);
    }

    private function get_solicitudes($profesor): array {
        $result = $this->db->query(
            "SELECT 
                G.id_grupo,
                G.codigo_grupo,
                G.nombreGrupo,
                COUNT(AG.id_grupo) AS numeroSolicitudes
            FROM 
                Grupo G
            JOIN 
                ProfesorGrupos PG ON G.id_grupo = PG.id_grupo
            LEFT JOIN 
                AlumnosGrupos AG ON G.id_grupo = AG.id_grupo
            WHERE 
                PG.rfcProf = ?
            GROUP BY 
                G.id_grupo, G.codigo_grupo, G.nombreGrupo;",
            [$profesor->id]
        );

        if (!$result) return [];

        return $result;
    }

    private function get_grupos($profesor): array {

        $result = $this->db->query(
            "SELECT 
                G.id_grupo,
                G.codigo_grupo,
                G.nombreGrupo,
                COUNT(AG.noControlAlum) AS cantidadAlumnos
            FROM 
                Grupo G
            JOIN 
                ProfesorGrupos PG ON G.id_grupo = PG.id_grupo
            LEFT JOIN 
                AlumnosGrupos AG ON G.id_grupo = AG.id_grupo
            WHERE 
                PG.rfcProf = ?
            GROUP BY 
                G.id_grupo, G.codigo_grupo, G.nombreGrupo;",
            [$profesor->id]
        );

        if (!$result) return [];

        return $result;
    }

    private function get_materias(): array {

        $result = $this->db->query("SELECT * FROM Materia");

        if (!$result) return [];

        return $result;
    }
}
