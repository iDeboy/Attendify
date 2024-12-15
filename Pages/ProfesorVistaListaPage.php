<div class="max-w-4xl p-0 mx-auto mb-4 rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">
    <div class="flex items-center justify-center p-5">
        <div class="w-full p-1 rounded-lg">
            <h1 class="text-xl text-H_393737"><?= "$Grupo->IdGrupo | $Grupo->NombreMateria" ?></h1>
        </div>
        <div class="relative inline-block">
            <!-- Botón para verificar si hay solicitudes de alumnos -->
            <button
                type="button"
                id="notificationButton"
                class="flex items-center gap-2 px-4 py-2 bg-white border rounded-md shadow-md marcar text-H_393737 hover:bg-gray-100">
                <span class="text-sm mdi mdi-account-multiple-plus text-H_393737"></span>
                Agregar
            </button>

            <!-- Ventanita flotante -->
            <div
                id="notificationMenu"
                class="absolute right-0 z-10 hidden mt-2 overflow-hidden bg-white border rounded-lg shadow-lg w-96">
                <!-- Encabezado de la ventanita -->
                <div class="flex items-center justify-between p-4 border-b">
                    <p class="font-medium text-gray-800">Solicitudes</p>
                    <button
                        id="closeNotificationMenu"
                        class="text-lg text-gray-600 hover:text-gray-800">
                        &times;
                    </button>
                </div>
                <!-- Lista de notificaciones -->
                <div class="overflow-y-auto max-h-60 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
                    <div class="p-4 mb-2 bg-white">

                        <?php if (count($Solicitudes) !== 0): ?>

                            <?php foreach ($Solicitudes as $key => $solicitud): ?>
                                <!-- Sección que representa el envio de una solicitud de acceso al profesor -->
                                <div class="flex items-center justify-between p-1 bg-white">
                                    <div class="flex items-center">
                                        <!-- Cantidad de alumnos en el grupo -->
                                        <span class="text-sm text-H_393737"><?= "$solicitud->NombreAlumno $solicitud->ApellidosAlumno" ?></span>
                                    </div>
                                    <div class="flex items-center">
                                        <!-- Botones para aceptar o rechazar al alumno del grupo -->
                                        <button class="m-1" data-id="<?= $solicitud->Id ?>"><span class="mdi mdi-check-bold text-xl text-[#86C286]"></span></button>
                                        <button class="m-1" data-id="<?= $solicitud->Id ?>"><span class="mdi mdi-close-thick text-xl text-[#F05D5D]"></span></button>
                                    </div>
                                </div>

                            <?php endforeach; ?>

                        <?php else: ?>
                            <span class="text-sm text-H_393737">No hay solicitudes</span>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-4xl p-6 mx-auto mb-2 rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">

    <div class="p-4 mb-6 rounded-md shadow bg-H_DAE5E0">

        <div class="flex items-center justify-between">
            <h1 class="mb-4 text-xl font-semibold text-H_393737"><?= $Clase->Tema ?></h1>
            <h1 class="mb-4 text-xl font-semibold text-H_393737">
                <span class="text-xl mdi mdi-calendar-clock text-H_393737"></span>
                <?= $Clase->Fecha ?>
            </h1>
        </div>

        <div class="h-[280px] overflow-y-auto p-1 mt-1">
            <?php if (count($Asistencias) !== 0): ?>
                <!-- El total de asistencias para este tema/lista -->
                <span class="text-H_393737">Total de asistencias: <?= count($Asistencias) ?></span>
                <div class="mt-2"></div>
                <!-- Mostrar alumnos -->
                <?php foreach ($Asistencias as $key => $asistencia): ?>
                    <div class="p-2 mb-2 bg-white rounded-md shadow-md">
                        <div class="flex items-center justify-between p-1 bg-white">
                            <div class="flex items-center">
                                <span class="mr-2 text-xl mdi mdi-school text-H_393737"></span>
                                <!-- Cantidad de alumnos en el grupo -->
                                <span class=" text-H_393737"><?= "$asistencia->Nombre $asistencia->Apellidos" ?></span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-2 text-xl mdi mdi-ip text-H_393737"></span>
                                <span class=" text-H_393737"><?= $asistencia->Ip ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="items-center justify-center h-[260px] flex">
                    <span class="mdi mdi-minus-circle text-xl text-[#8da99d] mr-2"></span>
                    <p class=" font-extrabold text-[#8da99d] text-xl">NO HAY ALUMNOS CON ASISTENCIA</p>
                </div>
            <?php endif; ?>
        </div>

    </div>

</div>