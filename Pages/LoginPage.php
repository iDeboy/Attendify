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

        <!-- vista login | hidden lo mantiene oculto -->
        <div class="login">

          <h1>Acceso</h1>
          <div class="w-[60px] h-[2px] bg-H_38813B mt-1 mb-10"></div>

          <form action="login" method="post">

            <?= render_template("Components/SeleccionAlumnoMaestro.php") ?>

            <div class="invisible mt-8"></div>

            <?php if (isset($Error)): ?>
              <?= render_template('Components/Error.php', ['Error' => $Error]) ?>
            <?php endif; ?>

            <div class="border-b-2 border-gray-400 contenedor_texto">

              <img class="icon" src="assets/img/email.svg" alt="email">

              <!-- ingresar correo electronico -->
              <input type="email"
                name="correo"
                placeholder="CORREO ELECTRONICO"
                class="caja_login" required>

            </div>

            <div class="mt-8 border-b-2 border-gray-400 contenedor_texto">

              <img class="icon" src="assets/img/psswd.svg" alt="password">

              <!-- ingresar contraseña -->
              <input type="password"
                name="password"
                placeholder="CONTRASEÑA"
                class="caja_login" required>

            </div>

            <!-- checkbox para mostrar contraseña - hacer que al marcarla se visualice y al desmarcar se vuelva a ocular -->
            <?php echo render_template("Components/Checkbox.php", ["Texto" => "Mostrar Contraseña"]) ?>


            <!-- boton de iniciar sesión -->
            <button type="submit" class="mt-14 boton">INICIAR SESIÓN</button>


          </form>

          <p class="texto mt-2 text-[16px] text-H_393737">¿No tienes una cuenta?
            <!-- vinvulo para mandar al registro -->
            <a href="registro" class="text-H_A7E08E hover:text-H_618762 texto">Regístrate</a>
          </p>

        </div>

        <footer class="flex items-center justify-center h-20">
          2024 &copy; Todos los créditos a los&nbsp;<a href="acerca-de#integrantes" class="block !select-text !p-0 transicion size-fit"><b>creadores</b></a>.
        </footer>

      </div>

    </div>

  </div>
</div>