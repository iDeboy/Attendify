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

<div class="max-w-4xl p-6 mx-auto rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">

    <div class="p-4 mb-6 rounded-md shadow bg-H_DAE5E0">

        <h2 class="mb-4 text-xl font-semibold text-H_393737">Agregar lista</h2>

        <div class="p-4 mb-2 bg-white rounded-md shadow-md">
            <section class="mt-1">
                <div class="flex flex-col items-center justify-between gap-4 p-1 bg-white">
                    <div class="w-full h-1/2">
                        <label class="text-base font-medium select-none text-H_393737">
                            Tema
                        </label>
                        <!-- Agregar el nombre del tema -->
                        <div class="mt-2">
                            <input
                                placeholder="Titulo del tema a ver"
                                type="text"
                                class="flex w-full h-10 px-3 py-2 text-sm bg-transparent border border-gray-300 rounded-md select-none placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                name="temaClase"
                                id="temaClase" />
                        </div>
                    </div>

                    <div class="flex w-full gap-4 h-1/2">

                        <div class="w-1/2">
                            <label class="text-base font-medium select-none text-H_393737">
                                Fecha
                            </label>
                            <!-- Agregar la fecha -->
                            <div class="mt-2">
                                <input
                                    placeholder="Fecha"
                                    type="date"
                                    class="flex w-full h-10 px-3 py-2 text-sm bg-transparent border border-gray-300 rounded-md select-none placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                    name="fechaClase"
                                    id="fechaClase" />
                            </div>
                        </div>

                        <div class="w-1/2">
                            <label class="text-base font-medium select-none text-H_393737">
                                Hora
                            </label>
                            <!-- Agregar el horario -->
                            <div class="mt-2">
                                <input
                                    placeholder="Hora en que inicia la clase"
                                    type="time"
                                    class="flex w-full h-10 px-3 py-2 text-sm bg-transparent border border-gray-300 rounded-md select-none placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                    name="horaClase"
                                    id="horaClase" />
                            </div>
                        </div>

                    </div>

                </div>
                <div class="flex items-center justify-center w-full mt-4">
                    <!-- Guarda el la lista -->
                    <button id="btnGuardar" class="text-sm select-none marcar text-H_393737" data-id="<?= $Grupo->IdGrupo ?>">
                        <span class="mdi mdi-content-save text-H_393737"></span>
                        Guardar
                    </button>
                    <!-- El boton se regresa a la vista ProfesorGrupoPage.php -->
                    <a href="profesor/grupos/<?= $Grupo->IdGrupo ?>" class="flex items-center justify-center ml-4 text-sm select-none marcar text-H_393737">
                        <span class="mdi mdi-cancel text-H_393737"></span>
                        Cancelar
                    </a>
                </div>
            </section>
        </div>

    </div>

</div>