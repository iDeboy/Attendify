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

<!-- ALUMNOS INSCRITOS -->
<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md animate-fade-in mb-2">

    <div class="bg-H_DAE5E0 p-4 rounded-md shadow mb-6">

        <h2 class="text-H_393737 font-semibold text-xl mb-4">Alumnos inscritos</h2>
        <div class="w-full rounded-lg p-1">
            <!-- Buscador - Se pueden buscar los alumnos inscritos al grupo correspondiente -->
            <div class="flex">
                <div class="flex w-10 items-center justify-center rounded-tl-lg rounded-bl-lg border-r border-gray-200 bg-white p-1">
                    <span class="mdi mdi-magnify text-xl text-H_393737 pointer-events-none"></span>
                </div>
                <!-- Aqui se encuentra la caja de texto del buscador -->
                <input type="text"
                    class="w-full text-H_393737 bg-white pl-2 text-base outline-0 relative tooltip-trigger"
                    placeholder="Buscar . . ."
                    id=""
                    title="Busca al alumno por su nombre completo">
                <!-- Boton de buscar -->
                <input type="button" value="Buscar" class=" bg-[#779688] p-2 rounded-tr-lg rounded-br-lg text-white font-semibold hover:bg-[#DAE5E0] hover:text-H_618762 transition-colors">
            </div>
        </div>

        <div class="h-[280px] overflow-y-auto p-1 mt-2">
            <!-- Muestra de como se representa el grupo -->
            <div class="bg-white p-4 rounded-md shadow-md mb-2">
                <div class="bg-white p-1 flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="mdi mdi-school text-xl mr-2 text-H_393737"></span>
                        <!-- Cantidad de alumnos en el grupo -->
                        <span class=" text-H_393737">{{Alumno.nombre}}{{Alumno.apellidos}}</span>
                    </div>
                    <div class="flex items-center">
                        <!-- Boton para ingresar al grupo | mandarlo a la vista del grupo -->
                        <span class=" text-H_393737">Asistencias: {{Total de asistencias en el grupo}}</span>
                    </div>
                </div>
            </div>

            <!-- Mostrar lo siguiente cuando no hay alumnos inscritos | lleva flex -->
            <div class="items-center justify-center h-[260px] hidden">
                <span class="mdi mdi-minus-circle text-xl text-[#8da99d] mr-2"></span>
                <p class=" font-extrabold text-[#8da99d] text-xl">NO HAY ALUMNOS INSCRITOS</p>
            </div>
        </div>

    </div>

</div>

<!-- LISTAS -->
<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md animate-fade-in mb-2">

    <div class="bg-H_DAE5E0 p-4 rounded-md shadow mb-6">

        <div class="flex justify-between items-center">
            <h2 class="text-H_393737 font-semibold text-xl mb-4">Listas</h2>
            <button class="marcar text-H_393737">
                <span class="mdi mdi-file-document-plus text-sm text-H_393737"></span>
                Crear
            </button>
        </div>

        <div class="h-[280px] overflow-y-auto p-1 mt-2">
            <!-- Muestra de como se representa el grupo -->
            <div class="bg-white p-4 rounded-md shadow-md mb-2">
                <h3 class="font-bold text-H_455B3C mb-2">{{TemasGrupoMateria.fecha:dd-MM-aaaa | HH:mm hrs}}</h3>
                <div class="bg-white p-1 flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="mdi mdi-book text-xl mr-2 text-H_393737"></span>
                        <span class=" text-H_393737">{{TemasGrupoMateria.tema}}</span>
                    </div>
                    <div class="flex items-center">
                        <!-- Boton para ver detalles de la lista -->
                        <button class="marcar text-H_393737">
                            <span class="mdi mdi-eye text-sm text-H_393737"></span>
                            Ver
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mostrar lo siguiente cuando no hay temas vistos | lleva flex -->
            <div class="items-center justify-center h-[260px] hidden">
                <span class="mdi mdi-home-group-remove text-xl text-[#8da99d] mr-2"></span>
                <p class=" font-extrabold text-[#8da99d] text-xl">NO HAY TEMAS VISTOS</p>
            </div>
        </div>

    </div>

</div>

<!-- GRAFICA -->
<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md animate-fade-in">

    <div class="bg-H_DAE5E0 p-4 rounded-md shadow mb-6">

        <div class="flex justify-between items-center">
            <h2 class="text-H_393737 font-semibold text-xl mb-4">Resumen</h2>
            <label class="text-white hidden" for="country">Materia</label>
            <!-- La grafica tendra la opción se mostrar las asistencias que se han obtenido a la semana o al mes -->
            <select class="select-none text-H_393737 h-10 p-1 rounded cursor-pointer bg-white w-fit min-w-[100px] border-[2.5px] border-[#DAE5E0] shadow-md transition-all ease-in-out" id="country">
                <option value="">Mostrar por . . .</option>
                <option value="">Semana</option>
                <option value="">Mes</option>
            </select>
        </div>

        <div class="p-1 mt-2">
            <!-- Grafica -->
            <div class="bg-white p-4 rounded-md shadow-md mb-2">
                <div class="bg-white p-1 flex justify-center items-center">
                    <!-- Para configurar las opciones de la grafica hay que ir grafica.js -->
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>