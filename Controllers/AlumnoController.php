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
        $clases = $this->get_clases_hoy($alumno);
        $solicitudes = $this->get_solicitudes($alumno);

        echo $this->renderer->view(
            'Pages/AlumnoPrincipalPage.php',
            ['Alumno' => $alumno, 'Clases' => $clases, 'Solicitudes' => $solicitudes],
            layout: 'Layouts/AlumnoLayout.php'
        );
    }

    public function grupo(string $grupoId) {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $grupo = $this->get_grupo($grupoId);
        if ($grupo === false)
            return http_response_code(404);

        $alumno = $_SESSION['Usuario'];
        $grupo = $this->get_grupos($alumno);
        $asistencias = $this->get_listas_asistencia($alumno);

        echo $this->renderer->view(
            'Pages/AlumnoGrupoPage.php',
            ['Alumno' => $alumno, 'Grupo' => $grupo, 'Asistencias' => $asistencias],
            layout: 'Layouts/AlumnoLayout.php'
        );
    }

    public function grupos_disponibles() {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $alumno = $_SESSION['Usuario'];
        $grupos = $this->get_grupos_disponibles($alumno);

        echo $this->renderer->view(
            'Pages/AlumnoGruposDispPage.php',
            ['Alumno' => $alumno, 'Grupos' => $grupos],
            layout: 'Layouts/AlumnoLayout.php'
        );
    }

    public function grupos_inscrito() {

        if (needs_login('Logeado', BASE_SITE . '/login')) return;

        $alumno = $_SESSION['Usuario'];
        $grupos = $this->get_grupos($alumno);

        echo $this->renderer->view(
            'Pages/AlumnoGruposInsPage.php',
            ['Alumno' => $alumno, 'Grupos' => $grupos],
            layout: 'Layouts/AlumnoLayout.php'
        );
    }

    private function get_clases_hoy($alumno): array {

        $result = $this->db->query(
            "SELECT 
                M.codigoMateria,
                G.codigo_grupo,
                M.nombreMateria,
                C.tema,
                DATE_FORMAT(C.fecha, '%d-%m-%Y | %H:%i hrs') AS fecha
            FROM 
                Clase C
            INNER JOIN 
                Materia M ON C.id_materia = M.id_materia
            INNER JOIN 
                Grupo G ON C.id_grupo = G.id_grupo
            INNER JOIN 
                AlumnosGrupos AG ON G.id_grupo = AG.id_grupo
            INNER JOIN 
                Alumno Al ON AG.noControlAlum = Al.noControl
            WHERE 
                AG.estado = 'Aceptado'
                AND Al.noControl = ?;
            ",
            [$alumno->id]
        );

        if (!$result) return [];

        return $result;
    }

    private function get_solicitudes($alumno): array {

        $result = $this->db->query(
            "SELECT 
                G.codigo_grupo,
                G.nombreGrupo,
                AG.estado
            FROM 
                AlumnosGrupos AG
            INNER JOIN 
                Grupo G ON AG.id_grupo = G.id_grupo
            WHERE 
                AG.noControlAlum = ?;
            ",
            [$alumno->id]
        );

        if (!$result) return [];

        return $result;
    }

    private function get_grupos_disponibles($alumno): array {

        $result = $this->db->query(
            "SELECT 
                G.id_grupo,
                G.codigo_grupo,
                G.nombreGrupo,
                P.nombre AS nombreProfesor
            FROM 
                Grupo G
            LEFT JOIN 
                AlumnosGrupos AG ON G.id_grupo = AG.id_grupo AND AG.noControlAlum = ?
            LEFT JOIN 
                ProfesorGrupos PG ON G.id_grupo = PG.id_grupo
            LEFT JOIN 
                Profesor P ON PG.rfcProf = P.rfc
            WHERE 
                AG.noControlAlum IS NULL;",
            [$alumno->id]
        );

        if (!$result) return [];

        return $result;
    }

    private function get_grupos($alumno): array {

        $result = $this->db->query(
            "SELECT 
                G.id_grupo,
                G.codigo_grupo,
                G.nombreGrupo,
                P.nombre AS nombreProfesor
            FROM 
                AlumnosGrupos AG
            INNER JOIN 
                Grupo G ON AG.id_grupo = G.id_grupo
            LEFT JOIN 
                ProfesorGrupos PG ON G.id_grupo = PG.id_grupo
            LEFT JOIN 
                Profesor P ON PG.rfcProf = P.rfc
            WHERE 
                AG.noControlAlum = ? AND AG.estado = 'Aceptado';",
            [$alumno->id]
        );

        if (!$result) return [];

        return $result;
    }

    private function get_listas_asistencia($alumno): array {

        $result = $this->db->query(
            "SELECT 
                A.id_asistencia,
                DATE_FORMAT(C.fecha, '%d-%m-%Y | %H:%i hrs') AS fechaClase,
                C.tema,
                G.codigo_grupo,
                G.nombreGrupo
            FROM 
                Asistencia A
            INNER JOIN 
                Clase C ON A.id_clase = C.id_clase
            INNER JOIN 
                Grupo G ON C.id_grupo = G.id_grupo
            WHERE 
                A.noControlAlum = ?
                AND A.estado = 'Ausente'
                AND C.fecha <= DATE_ADD(A.fechaAsistencia, INTERVAL 10 MINUTE)
                AND G.id_grupo IN (
                    SELECT AG.id_grupo 
                    FROM AlumnosGrupos AG 
                    WHERE AG.noControlAlum = ?
                    AND AG.estado = 'Aceptado'
                )
            ORDER BY 
                C.fecha DESC;",
            [$alumno->id, $alumno->id]
        );

        if (!$result) return [];

        return $result;
    }

    private function get_grupo(string $grupoId): object|false {

        $result = $this->db->query(
            "SELECT * FROM Grupo WHERE id_grupo = ?",
            [$grupoId]
        );

        if ($result === false || empty($result)) return false;

        return $result[0];
    }
}
