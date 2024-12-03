<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset='utf-8'>
    <!-- <base href="/" /> -->
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <?php foreach ($Styles as $key => $style): ?>
        <link rel='stylesheet' href="<?php echo $style; ?>">
    <?php endforeach; ?>

    <title>Sistema de Asistencia a clases</title>

</head>

<body>

    <?= $Body; ?>

    <?php foreach ($Scripts as $key => $script): ?>
        <script src="<?php echo $script; ?>"></script>
    <?php endforeach; ?>
</body>

</html>