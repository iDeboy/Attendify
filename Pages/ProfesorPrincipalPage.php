<div class="max-w-4xl p-6 mx-auto mb-4 rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">
    <h2 class="text-xl font-semibold text-H_393737">Bienvenid@ <?= $Profesor->Nombre ?>, ¡Que tengas un excelente día!</h2>
</div>

<div class="max-w-4xl p-6 mx-auto rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">

    <!-- Solicitudes enviadas | En esta sección se mostraran los grupos que tengan solicitudes pendientes -->
    <div class="p-4 rounded-md shadow bg-H_DAE5E0">

        <h2 class="mb-4 text-xl font-semibold text-H_393737">Solicitudes enviadas</h2>

        <div class="h-[150px] overflow-y-auto p-1">
            <!-- Recuadro de grupo -->

            <?php if (count($Solicitudes) !== 0): ?>

                <?php foreach ($Solicitudes as $key => $solicitud): ?>

                    <div class="flex items-center justify-between p-4 mb-2 bg-white rounded-md shadow-md">
                        <div class="flex items-center gap-2">
                            <span class="flex items-center justify-center mr-3 text-sm font-bold text-white bg-red-600 rounded-full select-none size-6">
                                <?= $solicitud->NumeroInscripciones ?>
                            </span>
                            <span class="text-xl mdi mdi-account-group text-H_393737"></span>
                            <!-- Mostrar el numero de solicitudes de ingreso -->
                            <span class=" text-H_393737"><?= "$solicitud->IdGrupo | $solicitud->NombreMateria" ?></span>
                        </div>
                    </div>

                <?php endforeach; ?>

            <?php else: ?>
                <!-- Mostrar lo siguiente cuando no hay grupos | lleva flex -->
                <div class="items-center justify-center h-[130px] flex">
                    <span class="mdi mdi-account-group text-xl text-[#8da99d] mr-2"></span>
                    <p class=" font-extrabold text-[#8da99d] text-xl">No tiene grupos que mostrar</p>
                </div>

            <?php endif; ?>
        </div>
    </div>

</div>