<div class="flex flex-col items-center justify-center w-full h-full min-h-screen bg-H_EBF3F0">
  <div class="max-w-4xl mt-8 text-center">
    <h1 class="mb-4 text-4xl font-bold text-H_393737">Acerca de nuestro equipo</h1>
    <h1 class="mb-4 text-4xl font-bold text-H_393737">Sobre el proyecto:</h1>
    <h2 class="mt-2 text-xl text-H_393737 text-balance">
      Nuestro proyecto tiene como objetivo desarrollar una aplicación web eficiente para la gestión de
      asistencia escolar, diseñada para alumnos y profesores con roles claramente definidos.
    </h2>

    <h3 class="mt-4 text-lg font-bold text-H_393737">Funciones de los alumnos</h3>
    <p class="text-lg text-H_393737 text-balance">
      Los alumnos podrán registrar sus datos personales, inscribirse en los grupos correspondientes y
      marcar su asistencia en horarios establecidos.
    </p>

    <h3 class="mt-4 text-lg font-bold text-H_393737">Funciones de los profesores</h3>
    <p class="text-lg text-H_393737 text-balance">
      Los profesores podrán registrar sus datos, autorizar a los alumnos en sus grupos,
      agregar temas impartidos en clase y generar resúmenes de asistencia, considerando las horas del semestre.
    </p>

    <h3 class="mt-4 text-lg font-bold text-H_393737">Seguridad y eficiencia</h3>
    <p class="text-lg text-H_393737 text-balance">
      La aplicación garantiza la seguridad mediante privilegios diferenciados, asegurando que
      cada usuario acceda solo a las funciones permitidas según su rol. De esta forma, buscamos
      ofrecer una herramienta eficiente y segura que facilite el control académico y la gestión de
      asistencia escolar.
    </p>
  </div>

  <div id="integrantes" class="max-w-4xl mt-8 space-y-2 text-center">
    <h1 class="mb-4 text-4xl font-bold text-H_393737">Integrantes:</h1>
  </div>

  <div class="flex flex-wrap justify-center gap-2 py-10">

    <!-- Miembro del equipo 1 -->
    <?= render_template(
      'Components/IntegranteCard.php',
      [
        'Foto' => 'assets/img/honorio.png',
        'Nombre' => 'Honorio Acosta Ruiz',
        'NoControl' => '20021188',
        'Rol' => 'Desarrollador Backend',
        'Github' => 'https://github.com/iDeboy',

      ]
    ) ?>

    <!-- Miembro del equipo 2 -->
    <?= render_template(
      'Components/IntegranteCard.php',
      [
        'Foto' => 'assets/img/laura.jpg',
        'Nombre' => 'Laura Espejo Alvarado',
        'NoControl' => '20021215',
        'Rol' => 'Diseñadora y Desarrolladora Frontend',
        'Github' => 'https://github.com/lauraE090',

      ]
    ) ?>

    <!-- Miembro del equipo 3 -->
    <?= render_template(
      'Components/IntegranteCard.php',
      [
        'Foto' => 'assets/img/eliot.jpg',
        'Nombre' => 'Eliot Yahve Hernandez Zaragoza',
        'NoControl' => '20021230',
        'Rol' => 'Desarrollador de base de datos',
        'Github' => 'https://github.com/Eliot16',

      ]
    ) ?>

    <!-- Miembro del equipo 4 -->
    <?= render_template(
      'Components/IntegranteCard.php',
      [
        'Foto' => 'assets/img/kitzia.jpg',
        'Nombre' => 'Kitzia Guadalupe Munive Cábal',
        'NoControl' => '20021257',
        'Rol' => 'Desarrolladora Frontend',
        'Github' => 'https://github.com/KMUNIVE',

      ]
    ) ?>
  </div>

  <div class="max-w-5xl my-2.5 text-center">
    <h2 class="mb-4 text-xl font-bold text-H_393737">Encontrarás nuestro proyecto en GitHub haciendo clic en:</h2>
    <div class="flex items-center justify-center mt-2 space-x-2 select-none">
      <a href="https://github.com/iDeboy/Attendify.git" target="_blank" class="flex items-center space-x-2 font-medium text-gray-600">
        <span class="text-xl mdi mdi-github"></span>
        <span class="text-xl">Proyecto Attendify</span>
      </a>
    </div>
  </div>
</div>