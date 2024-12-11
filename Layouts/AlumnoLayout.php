<div class="flex flex-col h-screen bg-H_E7EBE9">
    <!-- Cabecera -->
    <header class="encabezado">
        <p class="nombreApp">Attendify</p>
        <div class="contenedor-usuario">
            <p class="texto select-none text-[18px]">{{Alumno.nombre}}{{Alumno.apellidos}}</p>
            <span class="mdi mdi-account-school usuario"></span>
        </div>
    </header>

    <!-- Línea de separación -->
    <div class="w-full h-[4px] bg-H_618762"></div>

    <div class="flex bg-H_E7EBE9 w-full h-screen p-0">
        <!-- Primer div: 1/4 del ancho -->
        <div class="w-[240px] bg-H_95C8AA p-4 flex-shrink-0">
            <!-- Contenido del primer div -->

            <div class="bg-H_DAE5E0 w-64 p-4 rounded-md shadow-md">
                <!-- Menú principal -->
                <nav class="space-y-2">
                    <!-- Elemento estático -->
                    <a href="#" class="block transicion text-[18px]">
                        <span class="mdi mdi-home mr-2 select-none text-[20px]"></span>
                        Inicio
                    </a>

                    <!-- Elemento desplegable -->
                    <div class="group">
                        <input type="checkbox" id="toggle-options" class="hidden peer">
                        <!-- Botón desplegable -->
                        <label for="toggle-options" class="block text-gray-700 hover:text-H_618762 rounded-md p-2 cursor-pointer select-none text-[18px]">
                            <!-- Icono de Material Design: solo visible si el checkbox no está marcado -->
                            <span class="mdi mdi-chevron-down mr-2 select-none text-[20px]"></span>
                            Grupos
                        </label>
                        <!-- Contenido desplegable -->
                        <div class="hidden peer-checked:block mt-1 pl-4 space-y-2">
                            <a href="#" class="block transicion text-[18px]">
                                <span class="mdi mdi-view-grid-plus mr-2 select-none text-[20px] "></span>
                                Inscribirse
                            </a>
                            <a href="#" class="block transicion text-[18px]">
                                <span class="mdi mdi-account-check mr-2 select-none text-[20px]"></span>
                                Inscrito
                            </a>
                        </div>
                    </div>

                    <!-- Elemento estático -->
                    <a href="#" class="block transicion text-[18px]">
                        <span class="mdi mdi-exit-to-app mr-2 select-none text-[20px]"></span>
                        Cerrar Cesión
                    </a>
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