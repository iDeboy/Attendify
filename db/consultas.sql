
-- Obtiene las solicitudes pendientes en el grupo de un profesor
SELECT g.Id AS IdGrupo, m.Nombre AS NombreMateria, COUNT(ig.Id) AS NumeroInscripciones
FROM Grupo g 
JOIN Materia m ON g.IdMateria = m.Id
JOIN InscripcionGrupo ig ON ig.IdGrupo = g.Id
WHERE g.RfcProfesor = ? AND ig.Estado = 'Pendiente'
GROUP BY g.Id, m.Nombre
ORDER BY MAX(ig.Fecha) DESC;