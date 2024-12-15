<div class="max-w-4xl p-6 mx-auto mb-4 rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">
    <h2 class="text-xl font-semibold text-H_393737">Bienvenid@ <?= $Alumno->Nombre ?>, ¡Hoy es un gran día para aprender!</h2>
</div>

<div class="max-w-4xl p-6 mx-auto rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">

    <!-- Asistencias pendientes -->
    <div class="p-4 mb-6 rounded-md shadow bg-H_DAE5E0">

        <h2 class="mb-4 text-xl font-semibold text-H_393737">Asistencias pendientes</h2>
        <?php if (count($Clases) !== 0): ?>
            <p class="mb-2 text-H_4B4848">Para el día de hoy tienes programadas: <b><?= count($Clases) ?></b></p>
        <?php endif; ?>

        <div class="h-[280px] overflow-y-auto p-1">
            <!-- Si no hay asistencias pendientes no aparecian los grupos de asistencias (como el que se muestra debajo), aparece por cada asistencia pendiente al dia actual -->
            <?php if (count($Clases) !== 0): ?>

                <?php foreach ($Clases as $key => $clase): ?>
                    <div class="p-4 mb-2 bg-white rounded-md shadow-md">
                        <h3 class="mb-2 font-bold text-H_455B3C"><?= "$clase->IdGrupo | $clase->NombreMateria" ?></h3>
                        <p class="mb-2 text-H_4B4848"><?= $clase->Tema ?></p>
                        <div class="flex items-center text-H_393737">
                            <span class="mr-2 text-xl mdi mdi-calendar-month"></span>
                            <span><?= $clase->Fecha ?></span>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <!-- Mostrar lo siguiente cuando no hay asistencias pendientes -->
                <div class="flex items-center justify-center h-[260px]">
                    <span class="mdi mdi-robot-happy text-xl text-[#8da99d] mr-2"></span>
                    <p class=" font-extrabold text-[#8da99d] text-xl">NO HAY ASISTENCIAS PENDIENTES</p>
                </div>

            <?php endif; ?>
        </div>

    </div>

    <!-- Solicitudes enviadas -->
    <div class="p-4 rounded-md shadow bg-H_DAE5E0">

        <h2 class="mb-4 text-xl font-semibold text-H_393737">Solicitudes enviadas</h2>

        <div class="h-[150px] overflow-y-auto p-1">

            <?php if (count($Solicitudes) !== 0): ?>

                <?php foreach ($Solicitudes as $key => $solicitud): ?>

                    <div class="flex items-center justify-between p-4 mb-2 bg-white rounded-md shadow-md">
                        <div class="flex items-center">
                            <span class="mr-2 text-xl mdi mdi-account-group text-H_393737"></span>
                            <!-- Verificar como obtenemos la materia a la que fue enviada la solicitud -->
                            <span class=" text-H_393737"><?= "$solicitud->IdGrupo | $solicitud->NombreMateria" ?></span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2 text-H_393737">Estado:</span>
                            <?php if (strcmp($solicitud->Estado, 'Pendiente') === 0): ?>
                                <span class="text-[#e9cf11] font-semibold">● pendiente</span>
                            <?php elseif (strcmp($solicitud->Estado, 'Aceptado') === 0): ?>
                                <span class="font-semibold text-H_6FCF97">● aceptado</span>
                            <?php elseif (strcmp($solicitud->Estado, 'Rechazado') === 0): ?>
                                <span class="text-[#d13e2c] font-semibold">● rechazado</span>
                            <?php endif; ?>
                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>
                <!-- Mostrar lo siguiente cuando no hay solicitudes enviadas | lleva flex -->
                <div class="flex items-center justify-center h-[130px]">
                    <span class="mdi mdi-send text-xl text-[#8da99d] mr-2"></span>
                    <p class=" font-extrabold text-[#8da99d] text-xl">No has enviado solicitudes</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>