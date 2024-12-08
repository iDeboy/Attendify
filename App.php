<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset='utf-8'>
    <base href="/" /> 
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&display=swap">

    <?php foreach ($Styles as $key => $style): ?>
        <link rel='stylesheet' href="<?php echo $style; ?>">
    <?php endforeach; ?>

    -- <link rel='stylesheet' href="assets/css/Attendify.css">

    <title>Attendify</title>

</head>

<body>

    <?= $Body; ?>

    <?php foreach ($Scripts as $key => $script): ?>
        <script src="<?php echo $script; ?>"></script>
    <?php endforeach; ?>
</body>

</html>