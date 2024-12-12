<div class="p-0 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md mb-4 animate-fade-in">
    <div class="flex items-center justify-center p-5">
        <div class="w-full rounded-lg p-1">
            <h1 class="text-H_393737 text-xl">{{Grupo.nombreGrupo}} | {{Materia.nombreMateria}}</h1>
        </div>
        <div class="relative inline-block">
            <!-- Botón para verificar si hay solicitudes de alumnos -->
            <button
                type="button"
                id="notificationButton"
                class="peer marcar text-H_393737 flex items-center gap-2 px-4 py-2 border rounded-md shadow-md bg-white hover:bg-gray-100">
                <span class="mdi mdi-account-multiple-plus text-sm text-H_393737"></span>
                Agregar
            </button>

            <!-- Ventanita flotante -->
            <div
                id="notificationMenu"
                class="peer-focus:block absolute right-0 mt-2 w-96 bg-white border rounded-lg shadow-lg overflow-hidden hidden">
                <!-- Encabezado de la ventanita -->
                <div class="p-4 border-b flex justify-between items-center">
                    <p class="font-medium text-gray-800">Solicitudes</p>
                    <button
                        id="closeNotificationMenu"
                        class="text-gray-600 hover:text-gray-800 text-lg">
                        &times;
                    </button>
                </div>
                <!-- Lista de notificaciones -->
                <div class="max-h-60 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
                    <div class="bg-white p-4 mb-2">
                        <!-- Sección que representa el envio de una solicitud de acceso al profesor -->
                        <div class="bg-white p-1 flex justify-between items-center">
                            <div class="flex items-center">
                                <!-- Cantidad de alumnos en el grupo -->
                                <span class=" text-H_393737 text-sm">{{Alumno.nombre}}{{Alumno.apellidos}}</span>
                            </div>
                            <div class="flex items-center">
                                <!-- Botones para aceptar o rechazar al alumno del grupo -->
                                <button class="m-1"><span class="mdi mdi-check-bold text-xl text-[#86C286]"></span></button>
                                <button class="m-1"><span class="mdi mdi-close-thick text-xl text-[#F05D5D]"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md animate-fade-in mb-2">

    <div class="bg-H_DAE5E0 p-4 rounded-md shadow mb-6">

        <div class="flex justify-between items-center">
            <h1 class="text-H_393737 font-semibold text-xl mb-4">{{TemasGrupoMateria.tema}}</h1>
            <h1 class="text-H_393737 font-semibold text-xl mb-4">
                <span class="mdi mdi-calendar-clock text-xl text-H_393737"></span>
                {{TemasGrupoMateria.fecha:dd-MM-aaaa | HH:mm hrs}}
            </h1>
        </div>

        <div class="h-[280px] overflow-y-auto p-1 mt-1">
            <!-- El total de asistencias para este tema/lista -->
            <span class="text-H_393737">Total de asistencias: {{Asistencias.Count}}</span>
            <div class="mt-2"></div>
            <!-- Mostrar alumnos -->
            <div class="bg-white p-2 rounded-md shadow-md mb-2">
                <div class="bg-white p-1 flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="mdi mdi-school text-xl mr-2 text-H_393737"></span>
                        <!-- Cantidad de alumnos en el grupo -->
                        <span class=" text-H_393737">{{Alumno.nombre}}{{Alumno.apellidos}}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>