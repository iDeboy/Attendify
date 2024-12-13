<div class="max-w-4xl p-0 mx-auto mb-4 rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">
    <div class="flex items-center justify-center p-5">
        <div class="w-full p-1 rounded-lg">
            <!-- Buscador - Se podra buscar un grupo por su nombre {{Grupo.nombreGrupo}}, aparecen los grupos en los que el alumno se encuentra inscrito. -->
            <div class="flex">
                <div class="flex items-center justify-center w-10 p-1 bg-white border-r border-gray-200 rounded-tl-lg rounded-bl-lg">
                    <span class="text-xl pointer-events-none mdi mdi-magnify text-H_393737"></span>
                </div>
                <!-- Aqui se encuentra la caja de texto del buscador -->
                <input type="text"
                    class="relative w-full pl-2 text-base bg-white text-H_393737 outline-0 tooltip-trigger"
                    placeholder="Buscar . . ."
                    id=""
                    title="Busca la materia por su codigo o nombre">
                <!-- Boton de buscar -->
                <input type="button" value="Buscar" class=" bg-[#779688] p-2 rounded-tr-lg rounded-br-lg text-white font-semibold hover:bg-[#DAE5E0] hover:text-H_618762 transition-colors">
            </div>
        </div>
        <a href="profesor/crear-grupo" class="flex items-center justify-center marcar text-H_393737">
            <span class="text-sm mdi mdi-view-grid-plus text-H_393737"></span>
            Crear
        </a>
    </div>
</div>

<div class="max-w-4xl p-6 mx-auto rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">

    <div class="p-4 mb-6 rounded-md shadow bg-H_DAE5E0">

        <h2 class="mb-4 text-xl font-semibold text-H_393737">Mis Grupos</h2>

        <div class="h-[280px] overflow-y-auto p-1">

            <?php if (count($Grupos) !== 0): ?>

                <?php foreach ($Grupos as $key => $grupo): ?>
                    <!-- Muestra de como se representa el grupo -->
                    <div class="p-4 mb-2 bg-white rounded-md shadow-md">
                        <h3 class="mb-2 font-bold text-H_455B3C"><?= "$grupo->IdGrupo | $grupo->NombreMateria" ?></h3>
                        <div class="flex items-center justify-between p-1 bg-white">
                            <div class="flex items-center">
                                <span class="mr-2 text-xl mdi mdi-school text-H_393737"></span>
                                <!-- Cantidad de alumnos en el grupo -->
                                <span class=" text-H_393737">Alumnos: <?= $grupo->CantidadAlumnos ?></span>
                            </div>
                            <div class="flex items-center">
                                <!-- Boton para ingresar al grupo | mandarlo a la vista del grupo -->
                                <button
                                    class="bg-[#DAE5E0] text-center w-44 h-10 relative text-H_393737 group select-none"
                                    type="button">
                                    <a href="profesor/grupos/<?= $grupo->IdGrupo ?>">
                                        <div
                                            class="bg-[#779688] h-8 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[168px] z-10 duration-500">
                                            <span class="text-xl text-white mdi mdi-arrow-right-thick"></span>
                                        </div>
                                        <p class="ml-10 translate-x-2">Ingresar</p>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <!-- Mostrar lo siguiente cuando no hay grupos disponibles | lleva flex -->
                <div class="items-center justify-center h-[260px] flex">
                    <span class="mdi mdi-home-group-remove text-xl text-[#8da99d] mr-2"></span>
                    <p class=" font-extrabold text-[#8da99d] text-xl">NO TIENE CREADO ALGUN GRUPO</p>
                </div>

            <?php endif; ?>
        </div>

    </div>

</div>