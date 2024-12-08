<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contenedores Centrados</title>
  <link href="../assets/css/Attendify.css" rel="stylesheet">
</head>
 
  <body>

    <div class="contenedor-principal">

      <div class="contenedor-login">

        <div class="elementos-login">

          <div class="elementos-izq">

            <img class="img-class" src="../assets/img/recurso-login.svg" alt="class">

          </div>

          <div class="elementos-der">

            <div class="tituloApp">

              <p class="nombreApp">Attendify</p>
              <div class="cuadroAdorn"></div>

            </div>

            <!-- vista login | hidden lo mantiene oculto -->
            <div class="login hidden">
              
              <h1>Acceso</h1>
              <div class="w-[60px] h-[2px] bg-H_38813B mt-1"></div>
              
              <form action="" method="post">

                <div class="contenedor_texto mt-20 border-b-2 border-gray-400">

                  <img class="icon" src="../assets/img/email.svg" alt="email">

                  <!-- correo electronico -->
                  <input type="text"
                    placeholder="CORREO ELECTRONICO"
                    class="caja_login">

                </div>

                <div class="contenedor_texto mt-8 border-b-2 border-gray-400">

                  <img class="icon" src="../assets/img/psswd.svg" alt="password">

                  <!-- contraseña -->
                  <input type="password"
                    placeholder="CONTRASEÑA"
                    class="caja_login">

                </div>

                <div class="mt-1 flex items-center justify-end space-x-2 w-full">
                  <input type="checkbox" class="form-checkbox text-blue-500">
                  <label class="text-sm text-H_393737 texto">Mostrar contraseña</label>
                </div>

                <!-- boton de iniciar sesión -->
                <button type="submit" class="boton mt-20" >INICIAR SESIÓN</button>

                <p class="texto mt-2 text-[16px] text-H_393737">¿No tienes una cuenta?
                  <!-- vinvulo para el registro --> 
                  <a href="#" class="text-H_A7E08E hover:text-H_618762 texto">Regístrate</a>
                </p>

              </form>

            </div>

            <!-- vista registro -->
            <div class="login pb-10">
              
              <h1>Registro</h1>
              <div class="w-[60px] h-[2px] bg-H_38813B mt-1"></div>
              
              <form action="" method="post">

                <p class="texto mt-10 text-[16px] text-H_393737">Identificación</p>

                <!-- guardar identificación -->
                <input type="text"
                  placeholder=""
                  class="caja_registro">

                <p class="texto mt-5 text-[16px] text-H_393737">Nombres</p>

                <!-- guardar nombres -->
                <input type="text"
                  placeholder=""
                  class="caja_registro">

                <p class="texto mt-5 text-[16px] text-H_393737">Apellidos</p>

                <!-- guardar apellidos -->
                <input type="text"
                  placeholder=""
                  class="caja_registro">

                <p class="texto mt-5 text-[16px] text-H_393737">Correo Electrónico</p>

                <!-- guardar email -->
                <input type="text"
                  placeholder=""
                  class="caja_registro">

                <p class="texto mt-5 text-[16px] text-H_393737">Contraseña</p>

                <!-- guardar contraseña -->
                <input type="password"
                  placeholder=""
                  class="caja_registro">
                
                <div class="w-full h-[25px] bg-H_DFE3DE"></div>
                <div class="mt-1 flex items-center justify-end space-x-2 w-full">
                  <input type="checkbox" class="form-checkbox text-blue-500">
                  <label class="text-sm text-H_393737 texto">Mostrar contraseña</label>
                </div>
                <p class="texto text-[12px] text-gray-400">Sugerencia: La contraseña debe ser de al menos 8 caracteres. Para hacerla más fuerte usa mayúsculas y minúsculas, números y símbolos como ! * ? $ % y ).</p>

                <p class="texto mt-5 text-[16px] text-H_393737">Confirmar Contraseña</p>

                <!-- guardar confirmación de contraseña -->
                <input type="password"
                  placeholder=""
                  class="caja_registro">

                <div class="w-full h-[25px] bg-H_DFE3DE"></div>
                <div class="mt-1 flex items-center justify-end space-x-2 w-full">
                  <input type="checkbox" class="form-checkbox text-blue-500">
                  <label class="text-sm text-H_393737 texto">Mostrar contraseña</label>
                </div>

                <p class="texto mt-4 text-[16px] text-H_393737">Teléfono</p>

                <!-- guardar teléfono -->
                <input type="tel"
                  placeholder=""
                  class="caja_registro">

                <button type="submit" class="boton mt-14" >REGISTRAR</button>

              </form>

            </div>

          </div>

        </div>

      </div>
    </div>

  </body>
</html>
