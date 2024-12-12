<div class="max-w-4xl p-6 mx-auto mb-4 rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">
    <h2 class="text-xl font-semibold text-H_393737"><?= "$Grupo->codigo_grupo | $Grupo->nombreGrupo" ?></h2>
</div>

<div class="max-w-4xl p-6 mx-auto rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">

    <!-- Listas de asistencias -->
    <div class="p-4 mb-6 rounded-md shadow bg-H_DAE5E0">

        <h2 class="mb-4 text-xl font-semibold text-H_393737">Marcar Asistencia</h2>

        <div class="h-[280px] overflow-y-auto p-1">
            <!-- Recuadro de muestra | Muestra de como se representan los temas a marcar asistencia -->

            <?php if (count($Asistencias) !== 0): ?>

                <?php foreach ($Asistencias as $key => $asistencia): ?>
                    <div class="p-4 mb-2 bg-white rounded-md shadow-md">
                        <h3 class="mb-2 font-bold text-H_455B3C"><?= $asistencia->fechaClase ?></h3>
                        <div class="flex items-center justify-between p-1 bg-white">
                            <div class="flex items-center overflow-hidden">
                                <span
                                    class="text-H_393737 truncate max-w-[500px] flex-shrink-0"
                                    title="{{TemasGrupoMateria.tema}}">
                                    <?= $asistencia->tema ?>
                                </span>
                            </div>
                            <div class="flex items-center">
                                <!-- Boton para marcar asistencia | Cuando sea marcarda, el recuadro de la muestra debe ser quitado, lo mismo sucede si no fue marcada en el tiempo estipulado -->
                                <button class="marcar text-H_393737">
                                    <span class="text-sm mdi mdi-check-bold text-H_393737"></span>
                                    Presente
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>

                <!-- Mostrar lo siguiente cuando no hay grupos disponibles | lleva flex -->
                <div class="items-center justify-center h-[260px] flex">
                    <span class="mdi mdi-robot-happy text-xl text-[#8da99d] mr-2"></span>
                    <p class=" font-extrabold text-[#8da99d] text-xl">NO HAY LISTAS PENDIENTES</p>
                </div>
                
            <?php endif; ?>
            
        </div>

    </div>

    <!-- Temas vistos en el grupo | una vez que pasa el tiempo para tomar la asistencia en una lista, este lista forma parte de esta sección -->
    <div class="hidden p-4 mb-6 rounded-md shadow bg-H_DAE5E0">

        <h2 class="mb-4 text-xl font-semibold text-H_393737">Temas vistos</h2>

        <div class="h-[280px] overflow-y-auto p-1">
            <!-- Recuadro de tema visto -->
            <div class="p-4 mb-2 bg-white rounded-md shadow-md">
                <h3 class="mb-2 font-bold text-H_455B3C">{{TemasGrupoMateria.tema}}</h3>
                <div class="flex items-center justify-between p-1 bg-white">
                    <div class="flex items-center overflow-hidden">
                        <span
                            class="text-H_393737 truncate max-w-[500px] flex-shrink-0"
                            title="{{TemasGrupoMateria.tema}}">
                            {{TemasGrupoMateria.fecha:dd-MM-aaaa | HH:mm hrs}}
                        </span>
                    </div>
                    <div class="flex items-center">
                        <!-- Mostrar el estado de la asistencia, si al tema estuvo presente o ausente -->
                        <span class="mr-2 text-H_393737">Estado: {{Asistencia.estado}}</span>
                    </div>
                </div>
            </div>
            <!-- Mostrar lo siguiente cuando no hay grupos disponibles | lleva flex -->
            <div class="items-center justify-center h-[260px] hidden">
                <span class="mdi mdi-robot-happy text-xl text-[#8da99d] mr-2"></span>
                <p class=" font-extrabold text-[#8da99d] text-xl">NO HAY ASISTENCIAS PENDIENTES</p>
            </div>
        </div>

    </div>

</div>