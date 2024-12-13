-- Insertar alumnos
INSERT INTO Alumno (NoControl, Nombre, Apellidos, Telefono, Correo, PasswordHash) VALUES
('A123456789', 'Juan', 'Pérez Gómez', '5551234567', 'juan.perez@correo.com', 'hashedpassword1'),
('B987654321', 'Ana', 'López Ramírez', '5552345678', 'ana.lopez@correo.com', 'hashedpassword2'),
('C123123123', 'Carlos', 'Martínez Soto', '5553456789', 'carlos.martinez@correo.com', 'hashedpassword3');

-- Insertar profesores
INSERT INTO Profesor (Rfc, Nombre, Apellidos, Telefono, Correo, PasswordHash) VALUES
('ABC123456789', 'Pedro', 'Sánchez Díaz', '5558765432', 'pedro.sanchez@correo.com', 'hashedpassword4'),
('DEF987654321', 'María', 'González Ruiz', '5559876543', 'maria.gonzalez@correo.com', 'hashedpassword5');

-- Insertar materias
INSERT INTO Materia (Id, Nombre) VALUES
('MAT', 'Matemáticas I'),
('FIS', 'Física I'),
('QMC', 'Química I');

-- Insertar grupos
INSERT INTO Grupo (RfcProfesor, IdMateria, Clave, Nombre, HorasSemanales) VALUES
('ABC123456789', 'MAT', 'A', 'Grupo A de Matemáticas I', 4),
('ABC123456789', 'FIS', 'B', 'Grupo B de Física I', 3),
('DEF987654321', 'QMC', 'C', 'Grupo C de Química I', 5);

-- Insertar inscripciones
INSERT INTO InscripcionGrupo (IdGrupo, IdAlumno, Fecha, Estado) VALUES
('MATA', 'A123456789', NOW(), 'Aceptado'),
('MATA', 'B987654321', NOW(), 'Pendiente'),
('FISB', 'A123456789', NOW(), 'Aceptado'),
('FISB', 'C123123123', NOW(), 'Rechazado'),
('QMCC', 'B987654321', NOW(), 'Pendiente');

-- Insertar clases
INSERT INTO Clase (IdGrupo, FechaInicio, Tema) VALUES
('MATA', NOW(), 'Funciones y límites'),
('FISB', NOW(), 'Leyes de Newton'),
('QMCC', NOW(), 'Estructura atómica');

-- Insertar asistencias
INSERT INTO Asistencia (IdClase, IdAlumno, Fecha, Ip) VALUES
(1, 'A123456789', NOW(), '192.168.1.1'),
(2, 'C123123123', NOW(), '192.168.1.2'),
(3, 'B987654321', NOW(), '192.168.1.3');
