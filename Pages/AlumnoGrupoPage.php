<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md mb-4 animate-fade-in">
    <h2 class="text-H_393737 font-semibold text-xl">{{Grupo.nombreGrupo}} | {{Materia.nombreMateria}}</h2>
</div>

<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md animate-fade-in">

    <!-- Listas de asistencias -->
    <div class="bg-H_DAE5E0 p-4 rounded-md shadow mb-6">

        <h2 class="text-H_393737 font-semibold text-xl mb-4">Marcar Asistencia</h2>

        <div class="h-[280px] overflow-y-auto p-1">
            <!-- Recuadro de muestra | Muestra de como se representan los temas a marcar asistencia -->
            <div class="bg-white p-4 shadow-md mb-2 rounded-md">
                <h3 class="font-bold text-H_455B3C mb-2">{{TemasGrupoMateria.fecha:dd-MM-aaaa | HH:mm hrs}}</h3>
                <div class="bg-white p-1 flex justify-between items-center">
                    <div class="flex items-center overflow-hidden">
                        <span
                            class="text-H_393737 truncate max-w-[500px] flex-shrink-0"
                            title="{{TemasGrupoMateria.tema}}">
                            {{TemasGrupoMateria.tema}}
                        </span>
                    </div>
                    <div class="flex items-center">
                        <!-- Boton para marcar asistencia | Cuando sea marcarda, el recuadro de la muestra debe ser quitado, lo mismo sucede si no fue marcada en el tiempo estipulado -->
                        <button class="marcar text-H_393737">
                            <span class="mdi mdi-check-bold text-sm text-H_393737"></span>
                            Presente
                        </button>
                    </div>
                </div>
            </div>
            <!-- Mostrar lo siguiente cuando no hay grupos disponibles | lleva flex -->
            <div class="items-center justify-center h-[260px] hidden">
                <span class="mdi mdi-robot-happy text-xl text-[#8da99d] mr-2"></span>
                <p class=" font-extrabold text-[#8da99d] text-xl">NO HAY LISTAS PENDIENTES</p>
            </div>
        </div>

    </div>

    <!-- Temas vistos en el grupo | una vez que pasa el tiempo para tomar la asistencia en una lista, este lista forma parte de esta sección -->
    <div class="bg-H_DAE5E0 p-4 rounded-md shadow mb-6">

        <h2 class="text-H_393737 font-semibold text-xl mb-4">Temas vistos</h2>

        <div class="h-[280px] overflow-y-auto p-1">
            <!-- Recuadro de tema visto -->
            <div class="bg-white p-4 shadow-md mb-2 rounded-md">
                <h3 class="font-bold text-H_455B3C mb-2">{{TemasGrupoMateria.tema}}</h3>
                <div class="bg-white p-1 flex justify-between items-center">
                    <div class="flex items-center overflow-hidden">
                        <span
                            class="text-H_393737 truncate max-w-[500px] flex-shrink-0"
                            title="{{TemasGrupoMateria.tema}}">
                            {{TemasGrupoMateria.fecha:dd-MM-aaaa | HH:mm hrs}}
                        </span>
                    </div>
                    <div class="flex items-center">
                        <!-- Mostrar el estado de la asistencia, si al tema estuvo presente o ausente -->
                        <span class="text-H_393737 mr-2">Estado: {{Asistencia.estado}}</span>
                    </div>
                </div>
            </div>
            <!-- Mostrar lo siguiente cuando no hay grupos disponibles | lleva flex -->
            <div class="items-center justify-center h-[260px] hidden">
                <span class="mdi mdi-robot-happy text-xl text-[#8da99d] mr-2"></span>
                <p class=" font-extrabold text-[#8da99d] text-xl">NO HAY ASISTENCIAS PENDIENTES</p>
            </div>
        </div>

    </div>

</div>