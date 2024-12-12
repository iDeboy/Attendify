<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md mb-4 animate-fade-in">
    <h2 class="text-H_393737 font-semibold text-xl">Bienvenid@ {{Alumno.nombre}}, ¡Hoy es un gran día para aprender!</h2>
</div>

<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md animate-fade-in">

    <!-- Asistencias pendientes -->
    <div class="bg-H_DAE5E0 p-4 rounded-md shadow mb-6">

        <h2 class="text-H_393737 font-semibold text-xl mb-4">Asistencias pendientes</h2>
        <p class="text-H_4B4848 mb-2">Para el día de hoy tienes programadas: <span class="font-bold">{{Alumno.Asistencias.Count}}</span></p>

        <div class="h-[280px] overflow-y-auto p-1">
            <!-- Si no hay asistencias pendientes no aparecian los grupos de asistencias (como el que se muestra debajo), aparece por cada asistencia pendiente al dia actual -->
            <div class="bg-white p-4 rounded-md shadow-md mb-2 hidden">
                <h3 class="font-bold text-H_455B3C mb-2">{{Grupo.nombreGrupo}} | {{Materia.nombreMateria}}</h3>
                <p class="text-H_4B4848 mb-2">{{TemasGrupoMateria.tema}}</p>
                <div class="flex items-center text-H_393737">
                    <span class="mdi mdi-calendar-month text-xl mr-2"></span>
                    <span>{{TemasGrupoMateria.fecha:dd-MM-aaaa | HH:mm hrs}}</span>
                </div>
            </div>
            <!-- Mostrar lo siguiente cuando no hay asistencias pendientes -->
            <div class="flex items-center justify-center h-[260px]">
                <span class="mdi mdi-robot-happy text-xl text-[#8da99d] mr-2"></span>
                <p class=" font-extrabold text-[#8da99d] text-xl">NO HAY ASISTENCIAS PENDIENTES</p>
            </div>
        </div>

    </div>

    <!-- Solicitudes enviadas -->
    <div class="bg-H_DAE5E0 p-4 rounded-md shadow">

        <h2 class="text-H_393737 font-semibold text-xl mb-4">Solicitudes enviadas</h2>

        <div class="h-[150px] overflow-y-auto p-1">
            <div class="bg-white p-4 rounded-md shadow-md flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <span class="mdi mdi-account-group text-xl mr-2 text-H_393737"></span>
                    <!-- Verificar como obtenemos la materia a la que fue enviada la solicitud -->
                    <span class=" text-H_393737">{{Grupo.nombreGrupo}} | {{Materia.nombreMateria}}</span>
                </div>
                <div class="flex items-center">
                    <span class="text-H_393737 mr-2">Estado:</span>
                    <span class="text-[#e9cf11] font-semibold">● pendiente</span>
                    <span class="text-H_6FCF97 font-semibold hidden">● aceptado</span>
                    <span class="text-[#d13e2c] font-semibold hidden">● rechazado</span>
                </div>
            </div>
            <!-- Mostrar lo siguiente cuando no hay solicitudes enviadas | lleva flex -->
            <div class="items-center justify-center h-[130px] hidden">
                <span class="mdi mdi-send text-xl text-[#8da99d] mr-2"></span>
                <p class=" font-extrabold text-[#8da99d] text-xl">No has enviado solicitudes</p>
            </div>
        </div>
    </div>

</div>