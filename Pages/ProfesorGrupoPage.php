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
                                        <button class="m-1 btnAceptarAlumno" data-id="<?= $solicitud->Id ?>"><span class="mdi mdi-check-bold text-xl text-[#86C286]"></span></button>
                                        <button class="m-1 btnRechazarAlumno" data-id="<?= $solicitud->Id ?>"><span class="mdi mdi-close-thick text-xl text-[#F05D5D]"></span></button>
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

<!-- ALUMNOS INSCRITOS -->
<div class="max-w-4xl p-6 mx-auto mb-2 rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">

    <div class="p-4 mb-6 rounded-md shadow bg-H_DAE5E0">

        <h2 class="mb-4 text-xl font-semibold text-H_393737">Alumnos inscritos</h2>
        <div class="w-full p-1 rounded-lg">
            <!-- Buscador - Se pueden buscar los alumnos inscritos al grupo correspondiente -->
            <div class="flex">
                <div class="flex items-center justify-center w-10 p-1 bg-white border-r border-gray-200 rounded-tl-lg rounded-bl-lg">
                    <span class="text-xl pointer-events-none mdi mdi-magnify text-H_393737"></span>
                </div>
                <!-- Aqui se encuentra la caja de texto del buscador -->
                <input type="text"
                    class="relative w-full pl-2 text-base bg-white text-H_393737 outline-0 tooltip-trigger"
                    placeholder="Buscar . . ."
                    id=""
                    title="Busca al alumno por su nombre completo">
                <!-- Boton de buscar -->
                <input type="button" value="Buscar" class=" bg-[#779688] p-2 rounded-tr-lg rounded-br-lg text-white font-semibold hover:bg-[#DAE5E0] hover:text-H_618762 transition-colors">
            </div>
        </div>

        <div class="h-[280px] overflow-y-auto p-1 mt-2">

            <?php if (count($Alumnos) !== 0): ?>

                <?php foreach ($Alumnos as $key => $alumno): ?>
                    <!-- Muestra de como se representa el grupo -->
                    <div class="p-4 mb-2 bg-white rounded-md shadow-md">
                        <div class="flex items-center justify-between p-1 bg-white">
                            <div class="flex items-center">
                                <span class="mr-2 text-xl mdi mdi-school text-H_393737"></span>
                                <!-- Cantidad de alumnos en el grupo -->
                                <span class=" text-H_393737"><?= "$alumno->Nombre $alumno->Apellidos" ?></span>
                            </div>
                            <div class="flex items-center">
                                <!-- Boton para ingresar al grupo | mandarlo a la vista del grupo -->
                                <span class=" text-H_393737">Asistencias: <?= $alumno->Asistencias ?></span>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <!-- Mostrar lo siguiente cuando no hay alumnos inscritos | lleva flex -->
                <div class="items-center justify-center h-[260px] flex">
                    <span class="mdi mdi-minus-circle text-xl text-[#8da99d] mr-2"></span>
                    <p class=" font-extrabold text-[#8da99d] text-xl">NO HAY ALUMNOS INSCRITOS</p>
                </div>

            <?php endif; ?>
        </div>

    </div>

</div>

<!-- LISTAS -->
<div class="max-w-4xl p-6 mx-auto mb-2 rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">

    <div class="p-4 mb-6 rounded-md shadow bg-H_DAE5E0">

        <div class="flex items-center justify-between">
            <h2 class="mb-4 text-xl font-semibold text-H_393737">Clases</h2>
            <a href="profesor/grupos/<?= $Grupo->IdGrupo ?>/crear-clase" class="flex items-center justify-center marcar text-H_393737">
                <span class="text-sm mdi mdi-file-document-plus text-H_393737"></span>
                Crear
            </a>
        </div>

        <div class="h-[280px] overflow-y-auto p-1 mt-2">
            <!-- Muestra de como se representa el grupo -->
            <?php if (count($Clases) !== 0): ?>

                <?php foreach ($Clases as $key => $clase): ?>

                    <div class="p-4 mb-2 bg-white rounded-md shadow-md">
                        <h3 class="mb-2 font-bold text-H_455B3C"><?= $clase->Fecha ?></h3>
                        <div class="flex items-center justify-between p-1 bg-white">
                            <div class="flex items-center">
                                <span class="mr-2 text-xl mdi mdi-book text-H_393737"></span>
                                <span class=" text-H_393737"><?= $clase->Tema ?></span>
                            </div>
                            <div class="flex items-center">
                                <!-- Boton para ver detalles de la lista -->
                                <a href="profesor/clases/<?= $clase->Id ?>" class="flex items-center justify-center marcar text-H_393737">
                                    <span class="text-sm mdi mdi-eye text-H_393737"></span>
                                    Ver
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <!-- Mostrar lo siguiente cuando no hay temas vistos | lleva flex -->
                <div class="items-center justify-center h-[260px] flex">
                    <span class="mdi mdi-home-group-remove text-xl text-[#8da99d] mr-2"></span>
                    <p class=" font-extrabold text-[#8da99d] text-xl">NO HAY TEMAS VISTOS</p>
                </div>

            <?php endif; ?>
        </div>

    </div>

</div>

<!-- GRAFICA -->
<div class="max-w-4xl p-6 mx-auto rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">

    <div class="p-4 mb-6 rounded-md shadow bg-H_DAE5E0">

        <div class="flex items-center justify-between">
            <h2 class="mb-4 text-xl font-semibold text-H_393737">Resumen</h2>
            <label class="hidden text-white" for="country">Materia</label>
            <!-- La grafica tendra la opción se mostrar las asistencias que se han obtenido a la semana o al mes -->
            <select class="select-none text-H_393737 h-10 p-1 rounded cursor-pointer bg-white w-fit min-w-[100px] border-[2.5px] border-[#DAE5E0] shadow-md transition-all ease-in-out" id="country">
                <option value="">Mostrar por . . .</option>
                <option value="">Semana</option>
                <option value="">Mes</option>
            </select>
        </div>

        <div class="p-1 mt-2">
            <!-- Grafica -->
            <div class="p-4 mb-2 bg-white rounded-md shadow-md">
                <div class="flex items-center justify-center p-1 bg-white">
                    <!-- Para configurar las opciones de la grafica hay que ir grafica.js -->
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>