<div class="contenedor-principal">

  <div class="contenedor-login">

    <div class="elementos-login">

      <div class="elementos-izq">

        <img class="img-class" src="assets/img/recurso-login.svg" alt="class">

      </div>

      <div class="elementos-der">

        <div class="tituloApp">

          <p class="nombreApp">Attendify</p>
          <div class="cuadroAdorn"></div>

        </div>

        <!-- vista registro -->
        <div class="pb-10 login">

          <h1>Registro</h1>
          <div class="w-[60px] h-[2px] bg-H_38813B mt-1 mb-10"></div>

          <!-- Cambiar el como se identificara el usuario, para el alumno es su No. Control y el docente es No. Identificación -->

          <form action="registro" method="post">

            <?php echo render_template("Components/SeleccionAlumnoMaestro.php") ?>

            <div class="invisible mt-8"></div>

            <?php if (isset($Errors)): ?>
              <?php foreach ($Errors as $key => $error): ?>
                <?= render_template('Components/Error.php', ['Error' => $error]) ?>
              <?php endforeach; ?>
            <?php endif; ?>

            <p id="textoId" class="texto text-[16px] text-H_393737">No. Control</p>

            <!-- guardar identificación -->
            <input type="text" class="caja_registro" name="id" required maxlength="20">

            <p class="texto mt-5 text-[16px] text-H_393737">Nombres</p>

            <!-- guardar nombres -->
            <input type="text" class="caja_registro" name="nombres" required maxlength="50" minlength="3">

            <p class="texto mt-5 text-[16px] text-H_393737">Apellidos</p>

            <!-- guardar apellidos -->
            <input type="text" class="caja_registro" name="apellidos" required maxlength="50" minlength="3">

            <p class="texto mt-5 text-[16px] text-H_393737">Correo Electrónico</p>

            <!-- guardar email -->
            <input type="email" class="caja_registro" name="correo" required maxlength="100">

            <p class="texto mt-5 text-[16px] text-H_393737">Contraseña</p>

            <!-- guardar contraseña -->
            <input type="password" class="caja_registro" name="password" required>

            <!-- checkbox para mostrar contraseña - hacer que al marcarla se visualice y al desmarcar se vuelva a ocular -->
            <?php echo render_template("Components/Checkbox.php", ["Texto" => "Mostrar Contraseña"]) ?>

            <p class="texto mt-5 text-[16px] text-H_393737">Confirmar Contraseña</p>

            <!-- guardar confirmación de contraseña -->
            <input type="password" class="caja_registro" name="confirmPassword" required>

            <!-- Sección donde se confirma si su contraseña es correcta o incorrecta -->
            <?php if (isset($Error)): ?>
              <div class="w-full h-[25px] bg-H_DFE3DE flex items-center p-2">
                <p class="texto text-[12px]">><?= $Error ?></p>
              </div>
            <?php endif; ?>

            <!-- checkbox para mostrar contraseña - hacer que al marcarla se visualice y al desmarcar se vuelva a ocular -->
            <?php echo render_template("Components/Checkbox.php", ["Texto" => "Mostrar Contraseña"]) ?>

            <p class="texto mt-4 text-[16px] text-H_393737">Teléfono</p>

            <!-- guardar teléfono -->
            <input type="tel" class="caja_registro" name="telefono" required maxlength="15">

            <!-- boton de registrar -->
            <button type="submit" class="boton mt-14">REGISTRAR</button>

          </form>

        </div>

        <footer class="flex items-center justify-center h-20">
          2024 &copy; Todos los créditos a los&nbsp;<a href="acerca-de#integrantes" class="block !select-text !p-0 transicion size-fit"><b>creadores</b></a>.
        </footer>

      </div>

    </div>

  </div>
</div>