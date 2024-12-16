<div class="max-w-4xl p-0 mx-auto mb-4 rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">
    <div class="flex items-center justify-center p-5">
        <?= render_template('Components/Buscador.php', ['Name' => 'materia', 'Value' => $Filtro]) ?>
    </div>
</div>

<div class="max-w-4xl p-6 mx-auto rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">

    <div class="p-4 mb-6 rounded-md shadow bg-H_DAE5E0">

        <h2 class="mb-4 text-xl font-semibold text-H_393737">Grupos disponibles</h2>

        <div class="h-[280px] overflow-y-auto p-1">
            <!-- Muestra de como se representa el grupo -->

            <?php if (count($Grupos) !== 0): ?>

                <?php foreach ($Grupos as $key => $grupo): ?>

                    <div class="p-4 mb-2 bg-white rounded-md shadow-md">
                        <h3 class="mb-2 font-bold text-H_455B3C"><?= "$grupo->Id | $grupo->NombreMateria" ?></h3>
                        <div class="flex items-center justify-between p-1 bg-white">
                            <div class="flex items-center">
                                <span class="mr-2 text-xl mdi mdi-town-hall text-H_393737"></span>
                                <span class=" text-H_393737">Impartido por: <?= "$grupo->NombreProfesor $grupo->ApellidosProfesor" ?></span>
                            </div>
                            <!-- Boton para que el alumno mande la solicitud de inscripción -->
                            <button id="btnInscribirse"
                                data-id="<?= $grupo->Id ?>"
                                class="bg-[#DAE5E0] text-center w-44 h-10 relative text-H_393737 group select-none">
                                <div
                                    class="bg-[#779688] h-8 w-1/4 flex items-center justify-center absolute right-1 top-[4px] group-hover:w-[168px] z-10 duration-500">
                                    <span class="text-xl text-white mdi mdi-plus"></span>
                                </div>
                                <p class="mr-10 translate-x-2">Inscribirse</p>
                            </button>

                        </div>
                    </div>

                <?php endforeach; ?>

            <?php else: ?>
                <!-- Mostrar lo siguiente cuando no hay grupos disponibles | lleva flex -->
                <div class="items-center justify-center h-[260px] flex">
                    <span class="mdi mdi-home-group-remove text-xl text-[#8da99d] mr-2"></span>
                    <p class=" font-extrabold text-[#8da99d] text-xl">NO HAY GRUPOS DISPONIBLES</p>
                </div>

            <?php endif; ?>
        </div>

    </div>

</div>