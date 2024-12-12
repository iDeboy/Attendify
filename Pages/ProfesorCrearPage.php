<div class="max-w-4xl p-6 mx-auto rounded-md shadow-md bg-H_EBF3F0 animate-fade-in">

    <div class="p-4 mb-6 rounded-md shadow bg-H_DAE5E0">

        <h2 class="mb-4 text-xl font-semibold text-H_393737">Agregar grupo</h2>

        <div class="p-4 mb-2 bg-white rounded-md shadow-md">
            <div class="mt-1" action="">
                <div class="flex items-center justify-between p-1 bg-white">
                    <div class="w-1/2">
                        <div class="p-1 xl:mx-auto xl:w-full xl:max-w-sm 2xl:max-w-md">
                            <div class="mb-2"></div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-base font-medium select-none text-H_393737">
                                        Grupo
                                    </label>
                                    <!-- Agregar el nombre del grupo -->
                                    <div class="mt-2">
                                        <input
                                            placeholder="Nombre del grupo"
                                            type="text"
                                            class="flex w-full h-10 px-3 py-2 text-sm bg-transparent border border-gray-300 rounded-md select-none placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                            name="nombreGrupo"
                                            id="nombreGrupo" />
                                    </div>
                                </div>
                                <div>
                                    <label class="text-base font-medium select-none text-H_393737">
                                        Materia
                                    </label>
                                    <!-- Elegir el nombre de la materia | al agregar una materia se debe visualizar, se ven todas las materias que ha agregado el profesor -->
                                    <label class="text-white select-none" for="country">Materia</label>
                                    <select id="materiaId" class="flex w-full h-10 px-3 py-2 mt-2 text-sm bg-transparent border border-gray-300 rounded-md select-none text-H_393737 placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50" id="country">
                                        <option value="0">Seleccionar materia</option>
                                        <?php foreach ($Materias as $key => $materia): ?>
                                            <option value="<?= $materia->id_materia ?>"><?= $materia->nombreMateria ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="w-1/2">
                        <div class="p-1 xl:mx-auto xl:w-full xl:max-w-sm 2xl:max-w-md">
                            <div class="mb-2"></div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-base font-medium select-none text-H_393737">
                                        Horas a la semana
                                    </label>
                                    <!-- Agregar las horas a las semana -->
                                    <div class="mt-2">
                                        <input
                                            placeholder="Horas de clase a la semana"
                                            type="number" min="1"
                                            class="flex w-full h-10 px-3 py-2 text-sm bg-transparent border border-gray-300 rounded-md select-none placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                            name="horasSemanales"
                                            id="horasSemanales" />
                                    </div>
                                </div>
                                <div>
                                    <label class="text-base font-medium text-white select-none">
                                        Hola
                                    </label>
                                    <div class="mt-2">
                                        <!-- El boton de agregar materia mostrara el div con el comentario de agregar materia -->
                                        <button id="btnAgregarMateria" class="text-sm marcar text-H_393737">
                                            <span class="mdi mdi-book-plus text-H_393737"></span>
                                            Agregar materia
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div id="agregarMateria" class="bg-white p-2 hidden justify-between items-center border-2 border-[#DAE5E0] m-2"> <!-- Agregar materia -->
                    <div class="w-1/2">
                        <div class="p-1 xl:mx-auto xl:w-full xl:max-w-sm 2xl:max-w-md">
                            <div class="mb-2"></div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-base font-medium select-none text-H_393737">
                                        Código
                                    </label>
                                    <!-- Agregar el codigo de la materia -->
                                    <div class="mt-2">
                                        <input
                                            placeholder="Código de la materia"
                                            type="text"
                                            class="flex w-full h-10 px-3 py-2 text-sm bg-transparent border border-gray-300 rounded-md select-none placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                            name="codigoMateria"
                                            id="codigoMateria" maxlength="20" minlength="1" />
                                    </div>
                                </div>
                                <div>
                                    <label class="text-base font-medium select-none text-H_393737">
                                        Nombre
                                    </label>
                                    <!-- Agregar el nombre de la materia -->
                                    <div class="mt-2">
                                        <input
                                            placeholder="Nombre de la materia"
                                            type="text"
                                            class="flex w-full h-10 px-3 py-2 text-sm bg-transparent border border-gray-300 rounded-md select-none placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                            name="nombreMateria"
                                            id="nombreMateria" maxlength="100" minlength="3" />
                                    </div>
                                </div>
                                <div>
                                    <label class="text-base font-medium text-white select-none">
                                        Hola
                                    </label>
                                    <div class="mt-2">
                                        <!-- Guardar la materia | al guardarla se cerrara la seccion de Agregar materia -->
                                        <button id="btnGuardarMateria" class="text-sm select-none marcar text-H_393737">
                                            <span class="mdi mdi-content-save text-H_393737"></span>
                                            Guardar
                                        </button>
                                        <!-- Al darle cancelar se cerrara esta sección de Agregar materia -->
                                        <button id="btnCancelarMateria" class="text-sm select-none marcar text-H_393737">
                                            <span class="mdi mdi-cancel text-H_393737"></span>
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center w-full">
                    <!-- Guarda el grupo -->
                    <button id="btnGuardarGrupo" class="text-sm select-none marcar text-H_393737">
                        <span class="mdi mdi-content-save text-H_393737"></span>
                        Guardar
                    </button>
                    <!-- El boton se regresa a la vista ProfesorCrearPage.php -->
                    <button class="ml-4 text-sm select-none marcar text-H_393737">
                        <a href="profesor/grupos">
                            <span class="mdi mdi-cancel text-H_393737"></span>
                            Cancelar
                        </a>
                    </button>
                </div>
            </div>
        </div>

    </div>

</div>