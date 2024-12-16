CREATE TABLE IF NOT EXISTS Alumno (
  NoControl VARCHAR(9) PRIMARY KEY NOT NULL, -- [A-Z]?[0-9]{8}
  Nombre VARCHAR(50) NOT NULL,               -- [A-Za-zÑÁÉÍÓÚñáéíóú ]{3,50}
  Apellidos VARCHAR(50) NOT NULL,            -- [A-Za-zÑÁÉÍÓÚñáéíóú ]{3,50}
  Telefono VARCHAR(15) NOT NULL UNIQUE,  -- [0-9]{10}
  Correo VARCHAR(100) NOT NULL UNIQUE,
  PasswordHash VARCHAR(255) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS Profesor (
  Rfc VARCHAR(13) PRIMARY KEY NOT NULL,       -- [A-ZÑ&]{3,4}\d{6}[A-Z0-9]{2}[0-9A]
  Nombre VARCHAR(50) NOT NULL,                -- [A-Za-zÑÁÉÍÓÚñáéíóú ]{3,50}
  Apellidos VARCHAR(50) NOT NULL,             -- [A-Za-zÑÁÉÍÓÚñáéíóú ]{3,50}
  Telefono VARCHAR(15) NOT NULL UNIQUE,       -- [0-9]{10}
  Correo VARCHAR(100) NOT NULL UNIQUE,
  PasswordHash VARCHAR(255) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS Materia (
  Id VARCHAR(3) PRIMARY KEY NOT NULL,        -- [0-9][A-Z][0-9]
  Nombre VARCHAR(50) NOT NULL                -- [0-9A-Za-zÑÁÉÍÓÚñáéíóú ]{3,50}
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS Grupo (
  RfcProfesor VARCHAR(13) NOT NULL,            -- [A-ZÑ&]{3,4}\d{6}[A-Z0-9]{2}[0-9A]
  IdMateria VARCHAR(3) NOT NULL,               -- [0-9][A-Z][0-9]
  Clave VARCHAR(1) NOT NULL,                   -- [A-Z]

  Id VARCHAR(4) GENERATED ALWAYS AS (CONCAT(IdMateria, Clave)) PERSISTENT UNIQUE KEY,

  -- Nombre VARCHAR(50) NOT NULL,               -- [A-Za-zÑÁÉÍÓÚñáéíóú ]{3,50}
  HorasSemanales INT NOT NULL,               -- > 1

  FOREIGN KEY (RfcProfesor) REFERENCES Profesor(Rfc) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (IdMateria) REFERENCES Materia(Id) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS InscripcionGrupo (
  
  Id INT AUTO_INCREMENT PRIMARY KEY,

  IdGrupo VARCHAR(4) NOT NULL,                     -- [0-9][A-Z][0-9][A-Z]
  IdAlumno VARCHAR(9) NOT NULL,                    -- [A-Z]?[0-9]{8}
  Fecha DATETIME NOT NULL DEFAULT NOW(),
  
  Estado ENUM('Pendiente', 'Aceptado', 'Rechazado') NOT NULL DEFAULT 'Pendiente',

  FOREIGN KEY (IdGrupo) REFERENCES Grupo(Id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (IdAlumno) REFERENCES Alumno(NoControl) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS Clase (
  
  Id INT AUTO_INCREMENT PRIMARY KEY,
  IdGrupo VARCHAR(4) NOT NULL,                       -- [0-9][A-Z][0-9][A-Z]
  FechaInicio DATETIME NOT NULL DEFAULT NOW(),
  Tema VARCHAR(255) NOT NULL,

  FOREIGN KEY (IdGrupo) REFERENCES Grupo(Id) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS Asistencia (
  
  Id INT AUTO_INCREMENT PRIMARY KEY,

  IdClase INT NOT NULL,
  IdAlumno VARCHAR(9) NOT NULL,             -- [A-Z]?[0-9]{8}

  Fecha DATETIME NOT NULL DEFAULT NOW(),
  Ip VARCHAR(39),

  FOREIGN KEY (IdClase) REFERENCES Clase(Id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (IdAlumno) REFERENCES Alumno(NoControl) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;