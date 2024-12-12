<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md mb-4 animate-fade-in">
    <h2 class="text-H_393737 font-semibold text-xl">Bienvenid@ {{Profesor.nombre}}, ¡Que tengas un excelente día!</h2>
</div>

<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md animate-fade-in">

    <!-- Solicitudes enviadas | En esta sección se mostraran los grupos que tengan solicitudes pendientes-->
    <div class="bg-H_DAE5E0 p-4 rounded-md shadow">

        <h2 class="text-H_393737 font-semibold text-xl mb-4">Solicitudes enviadas</h2>

        <div class="h-[150px] overflow-y-auto p-1">
            <!-- Recuadro de grupo -->
            <div class="bg-white p-4 rounded-md shadow-md flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <span class="mdi mdi-account-group text-xl mr-2 text-H_393737"></span>
                    <!-- Mostrar el numero de solicitudes de ingreso -->
                    <span class=" text-H_393737">{{Grupo.nombreGrupo}} | {{Materia.nombreMateria}} : {{Numero de solicitudes}}</span>
                </div>
            </div>
            <!-- Mostrar lo siguiente cuando no hay grupos | lleva flex -->
            <div class="items-center justify-center h-[130px] hidden">
                <span class="mdi mdi-account-group text-xl text-[#8da99d] mr-2"></span>
                <p class=" font-extrabold text-[#8da99d] text-xl">No tiene grupos que mostrar</p>
            </div>
        </div>
    </div>

</div>