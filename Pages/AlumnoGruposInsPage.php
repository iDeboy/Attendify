<div class="p-0 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md mb-4 animate-fade-in">
    <div class="p-0 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md mb-4">
        <div class="flex items-center justify-center p-5">
            <div class="w-full rounded-lg p-1">
                <!-- Buscador - Se podra buscar un grupo por su nombre {{Grupo.nombreGrupo}}, aparecen los grupos en los que el alumno se encuentra inscrito. -->
                <div class="flex">
                    <div class="flex w-10 items-center justify-center rounded-tl-lg rounded-bl-lg border-r border-gray-200 bg-white p-1">
                        <span class="mdi mdi-magnify text-xl text-H_393737 pointer-events-none"></span>
                    </div>
                    <!-- Aqui se encuentra la caja de texto del buscador -->
                    <input type="text"
                        class="w-full text-H_393737 bg-white pl-2 text-base outline-0 relative tooltip-trigger"
                        placeholder="Buscar . . ."
                        id=""
                        title="Busca la materia por su codigo o nombre">
                    <!-- Boton de buscar -->
                    <input type="button" value="Buscar" class=" bg-[#779688] p-2 rounded-tr-lg rounded-br-lg text-white font-semibold hover:bg-[#DAE5E0] hover:text-H_618762 transition-colors">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md animate-fade-in">

    <div class="bg-H_DAE5E0 p-4 rounded-md shadow mb-6">

        <h2 class="text-H_393737 font-semibold text-xl mb-4">Mis Grupos</h2>

        <div class="h-[280px] overflow-y-auto p-1">
            <!-- Muestra de como se representa el grupo -->
            <div class="bg-white p-4 rounded-md shadow-md mb-2">
                <h3 class="font-bold text-H_455B3C mb-2">{{Grupo.nombreGrupo}} | {{Materia.nombreMateria}}</h3>
                <div class="bg-white p-1 flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="mdi mdi-town-hall text-xl mr-2 text-H_393737"></span>
                        <span class=" text-H_393737">Impartido por: {{Profesor.nombre}}</span>
                    </div>
                    <div class="flex items-center">
                        <!-- Boton para ingresar al grupo | mandarlo a la vista del grupo -->
                        <button
                            class="bg-[#DAE5E0] text-center w-44 h-10 relative text-H_393737 group select-none"
                            type="button">
                            <div
                                class="bg-[#779688] h-8 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[168px] z-10 duration-500">
                                <span class="mdi mdi-arrow-right-thick text-xl text-white"></span>
                            </div>
                            <p class="translate-x-2 ml-10">Ingresar</p>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Mostrar lo siguiente cuando no hay grupos disponibles | lleva flex -->
            <div class="items-center justify-center h-[260px] hidden">
                <span class="mdi mdi-home-group-remove text-xl text-[#8da99d] mr-2"></span>
                <p class=" font-extrabold text-[#8da99d] text-xl">NO HAY GRUPOS DISPONIBLES</p>
            </div>
        </div>

    </div>

</div>