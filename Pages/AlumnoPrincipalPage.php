<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md mb-4">
    <h2 class="text-H_393737 font-semibold text-xl">Bienvenid@ {{Alumno.nombre}}{{Alumno.apellidos}}, ¡Hoy es un gran día para aprender!</h2>
</div>

<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md">

    <!-- Asistencias pendientes -->
    <div class="bg-H_DAE5E0 p-4 rounded-md shadow mb-6">
        <h2 class="text-H_393737 font-semibold text-xl mb-4">Asistencias pendientes</h2>
        <p class="text-H_4B4848 mb-2">Para el día de hoy tienes programadas: <span class="font-bold">{{Alumno.Asistencias.Count}}</span></p>

        <div class="bg-white p-4 rounded-md shadow-md mb-2">
            <h3 class="font-bold text-H_455B3C mb-2">{{Materia.codigoMateria}} | {{Materia.nombreMateria}}</h3>
            <p class="text-H_4B4848 mb-2">{{TemasGrupoMateria.tema}}</p>
            <div class="flex items-center text-H_393737">
                <span class="mdi mdi-calendar-month text-xl mr-2"></span>
                <span>{{TemasGrupoMateria.fecha:dd-MM-aaaa | HH:mm hrs}}</span>
            </div>
        </div>
    </div>

</div>