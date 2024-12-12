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

<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md animate-fade-in">

    <div class="bg-H_DAE5E0 p-4 rounded-md shadow mb-6">

        <h2 class="text-H_393737 font-semibold text-xl mb-4">Agregar lista</h2>

        <div class="bg-white p-4 rounded-md shadow-md mb-2">
            <form class="mt-1">
                <div class="bg-white p-1 flex justify-between items-center">
                    <div class="w-1/2">
                        <div class="xl:mx-auto p-1 xl:w-full xl:max-w-sm 2xl:max-w-md">
                            <div class="mb-2"></div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-base font-medium text-H_393737 select-none">
                                        Tema
                                    </label>
                                    <!-- Agregar el nombre del tema -->
                                    <div class="mt-2">
                                        <input
                                            placeholder="Titulo del tema a ver"
                                            type="text"
                                            class="select-none flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                            name="user_name" />
                                    </div>
                                </div>
                                <div>
                                    <label class="text-base font-medium text-H_393737 select-none">
                                        Fecha
                                    </label>
                                    <!-- Agregar la fecha -->
                                    <div class="mt-2">
                                        <input
                                            placeholder="Fecha"
                                            type="date"
                                            class="select-none flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                            name="user_name" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="w-1/2">
                        <div class="xl:mx-auto p-1 xl:w-full xl:max-w-sm 2xl:max-w-md">
                            <div class="mb-2"></div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-base font-medium text-H_393737 select-none">
                                        Semestre
                                    </label>
                                    <!-- Agregar el semestre -->
                                    <div class="mt-2">
                                        <input
                                            placeholder="Ingrese el semestre"
                                            type="number"
                                            class="select-none flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                            name="user_name" />
                                    </div>
                                </div>
                                <div>
                                    <label class="text-base font-medium text-H_393737 select-none">
                                        Hora
                                    </label>
                                    <!-- Agregar el horario -->
                                    <div class="mt-2">
                                        <input
                                            placeholder="Hora en que inicia la clase"
                                            type="time"
                                            class="select-none flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                            name="user_name" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="w-full flex items-center justify-center mt-4">
                    <!-- Guarda el la lista -->
                    <button class="marcar text-H_393737 text-sm select-none">
                        <span class="mdi mdi-content-save text-H_393737"></span>
                        Guardar
                    </button>
                    <!-- El boton se regresa a la vista ProfesorGrupoPage.php -->
                    <button class="marcar text-H_393737 text-sm ml-4 select-none">
                        <span class="mdi mdi-cancel text-H_393737"></span>
                        Cancelar
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>