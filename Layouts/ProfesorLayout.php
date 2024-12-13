<div class="flex flex-col h-screen bg-H_E7EBE9">
    <!-- Cabecera -->
    <header class="encabezado">
        <p class="nombreApp">Attendify</p>
        <div class="contenedor-usuario">
            <p class="texto select-none text-[18px]"><?= "$Profesor->Nombre $Profesor->Apellidos" ?></p>
            <span class="mdi mdi-account-school usuario"></span>
        </div>
    </header>

    <!-- Línea de separación -->
    <div class="w-full h-[4px] bg-H_618762"></div>

    <div class="flex w-full h-screen p-0 bg-H_E7EBE9">
        <!-- Primer div: 1/4 del ancho -->
        <div class="w-[240px] bg-H_95C8AA p-4 flex-shrink-0">
            <!-- Contenido del primer div -->

            <div class="w-64 p-4 rounded-md shadow-md bg-H_DAE5E0">
                <!-- Menú principal -->
                <nav class="space-y-2">
                    <!-- Ir a la vista principal del docente -->
                    <a href="profesor" class="block transicion text-[18px]">
                        <span class="mdi mdi-home mr-2 select-none text-[20px]"></span>
                        Inicio
                    </a>

                    <!-- Ir a la vista de grupos | grupos que tiene creados -->
                    <a href="profesor/grupos" class="block transicion text-[18px]">
                        <span class="mdi mdi-account-group mr-2 select-none text-[20px]"></span>
                        Grupos
                    </a>

                    <!-- Regresar al apartado de iniciar sesión -->
                    <form action="logout" method="post">
                        <button type="submit" class="block transicion text-[18px] w-full text-start">
                            <span class="mdi mdi-exit-to-app mr-2 select-none text-[20px]"></span>
                            Cerrar Cesión
                        </button>
                    </form>
                </nav>
            </div>


        </div>

        <!-- Segundo div: ocupa el resto del espacio -->
        <div class="flex-1 bg-H_E7EBE9 p-4 overflow-y-auto h-[calc(100vh-80px)]">
            <!-- Contenido del segundo div -->
            <?php
                echo $Body;
            ?>
            
        </div>
    </div>
</div>