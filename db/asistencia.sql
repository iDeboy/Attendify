CREATE TABLE IF NOT EXISTS Alumno (
  noControl VARCHAR(20) PRIMARY KEY NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  apellidos VARCHAR(50) NOT NULL,
  telefono VARCHAR(15) DEFAULT NULL,
  correoAlum VARCHAR(100) NOT NULL UNIQUE,
  passwordHash VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE UNIQUE INDEX idx_correo_alumno ON Alumno(correoAlum);

CREATE TABLE IF NOT EXISTS Profesor (
  rfc VARCHAR(13) PRIMARY KEY NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  apellidos VARCHAR(50) NOT NULL,
  telefono VARCHAR(15) DEFAULT NULL,
  correoProf VARCHAR(100) NOT NULL UNIQUE,
  passwordHash VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE UNIQUE INDEX idx_correo_profesor ON Profesor(correoProf);

CREATE TABLE IF NOT EXISTS Materia (
  id_materia INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  nombreMateria VARCHAR(100) NOT NULL,
  codigoMateria VARCHAR(20) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE UNIQUE INDEX idx_codigo_materia ON Materia(codigoMateria);

CREATE TABLE IF NOT EXISTS Grupo (
  id_grupo INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  nombreGrupo VARCHAR(50) NOT NULL,
  horas_semanales INT(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS Asistencia (
  id_asistencia INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  fechaAsistencia DATETIME NOT NULL DEFAULT NOW(),
  ipRegistro VARCHAR(45) DEFAULT NULL,
  estado ENUM('Presente','Ausente') NOT NULL DEFAULT 'Presente',

  id_materia INT(11) NOT NULL,
  noControlAlum VARCHAR(20) NOT NULL,

  FOREIGN KEY (id_materia) REFERENCES Materia(id_materia) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (noControlAlum) REFERENCES Alumno(noControl) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS AlumnosGrupos (
  id_grupo INT(11) NOT NULL,
  noControlAlum VARCHAR(20) NOT NULL,
  estado ENUM('Pendiente', 'Aceptado', 'Rechazado') NOT NULL DEFAULT 'Pendiente',

  PRIMARY KEY (id_grupo, noControlAlum),
  FOREIGN KEY (id_grupo) REFERENCES Grupo(id_grupo) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (noControlAlum) REFERENCES Alumno(noControl) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS ProfesorGrupos (
  id_grupo INT(11) NOT NULL,
  rfcProf VARCHAR(13) NOT NULL,

  PRIMARY KEY (id_grupo, rfcProf),
  FOREIGN KEY (id_grupo) REFERENCES Grupo(id_grupo) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (rfcProf) REFERENCES Profesor(rfc) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS TemasGrupoMateria (
  id_tema INT(11) AUTO_INCREMENT NOT NULL,
  id_grupo INT(11) NOT NULL,
  id_materia INT(11) NOT NULL,
  fecha DATETIME NOT NULL,
  tema VARCHAR(255) NOT NULL,

  PRIMARY KEY (id_tema, id_grupo, id_materia),

  FOREIGN KEY (id_grupo) REFERENCES Grupo(id_grupo) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (id_materia) REFERENCES Materia(id_materia) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;