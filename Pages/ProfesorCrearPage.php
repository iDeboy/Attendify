<div class="p-6 max-w-4xl mx-auto bg-H_EBF3F0 rounded-md shadow-md animate-fade-in">

    <div class="bg-H_DAE5E0 p-4 rounded-md shadow mb-6">

        <h2 class="text-H_393737 font-semibold text-xl mb-4">Agregar grupo</h2>

        <div class="bg-white p-4 rounded-md shadow-md mb-2">
            <form class="mt-1">
                <div class="bg-white p-1 flex justify-between items-center">
                    <div class="w-1/2">
                        <div class="xl:mx-auto p-1 xl:w-full xl:max-w-sm 2xl:max-w-md">
                            <div class="mb-2"></div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-base font-medium text-H_393737 select-none">
                                        Grupo
                                    </label>
                                    <!-- Agregar el nombre del grupo -->
                                    <div class="mt-2">
                                        <input
                                            placeholder="Nombre del grupo"
                                            type="text"
                                            class="select-none flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                            name="user_name" />
                                    </div>
                                </div>
                                <div>
                                    <label class="text-base font-medium text-H_393737 select-none">
                                        Materia
                                    </label>
                                    <!-- Elegir el nombre de la materia | al agregar una materia se debe visualizar, se ven todas las materias que ha agregado el profesor -->
                                    <label class="text-white select-none" for="country">Materia</label>
                                    <select class="select-none text-H_393737 mt-2 flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50" id="country">
                                        <option value="">Seleccionar materia</option>
                                        <option value="">{{Materia.nombreMateria}}</option>
                                    </select>
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
                                        Horas a la semana
                                    </label>
                                    <!-- Agregar las horas a las semana -->
                                    <div class="mt-2">
                                        <input
                                            placeholder="Horas de clase a la semana"
                                            type="number"
                                            class="select-none flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                            name="user_name" />
                                    </div>
                                </div>
                                <div>
                                    <label class="text-base font-medium text-white select-none">
                                        Hola
                                    </label>
                                    <div class="mt-2">
                                        <!-- El boton de agregar materia mostrara el div con el comentario de agregar materia -->
                                        <button class="marcar text-H_393737 text-sm">
                                            <span class="mdi mdi-book-plus text-H_393737"></span>
                                            Agregar materia
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="bg-white p-2 flex justify-between items-center border-2 border-[#DAE5E0] m-2"> <!-- Agregar materia -->
                    <div class="w-1/2">
                        <div class="xl:mx-auto p-1 xl:w-full xl:max-w-sm 2xl:max-w-md">
                            <div class="mb-2"></div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-base font-medium text-H_393737 select-none">
                                        Código
                                    </label>
                                    <!-- Agregar el codigo de la materia -->
                                    <div class="mt-2">
                                        <input
                                            placeholder="Código de la materia"
                                            type="text"
                                            class="select-none flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                            name="user_name" />
                                    </div>
                                </div>
                                <div>
                                    <label class="text-base font-medium text-H_393737 select-none">
                                        Nombre
                                    </label>
                                    <!-- Agregar el nombre de la materia -->
                                    <div class="mt-2">
                                        <input
                                            placeholder="Nombre de la materia"
                                            type="text"
                                            class="select-none flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                            name="user_name" />
                                    </div>
                                </div>
                                <div>
                                    <label class="text-base font-medium text-white select-none">
                                        Hola
                                    </label>
                                    <div class="mt-2">
                                        <!-- Guardar la materia | al guardarla se cerrara la seccion de Agregar materia -->
                                        <button class="marcar text-H_393737 text-sm select-none">
                                            <span class="mdi mdi-content-save text-H_393737"></span>
                                            Guardar
                                        </button>
                                        <!-- Al darle cancelar se cerrara esta sección de Agregar materia -->
                                        <button class="marcar text-H_393737 text-sm select-none">
                                            <span class="mdi mdi-cancel text-H_393737"></span>
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex items-center justify-center">
                    <!-- Guarda el grupo -->
                    <button class="marcar text-H_393737 text-sm select-none">
                        <span class="mdi mdi-content-save text-H_393737"></span>
                        Guardar
                    </button>
                    <!-- El boton se regresa a la vista ProfesorCrearPage.php -->
                    <button class="marcar text-H_393737 text-sm ml-4 select-none">
                        <span class="mdi mdi-cancel text-H_393737"></span>
                        Cancelar
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>