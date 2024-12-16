<div class="flex flex-col items-center p-6 rounded-md shadow-lg bg-H_EBF3F0 w-72">
    <img class="object-cover w-40 h-40 mb-4 rounded-full select-none" src="<?= $Foto ?>" alt="Honorio">
    <div class="grid w-full h-full grid-rows-4 text-center">

        <h2 class="mt-2 text-xl font-bold text-H_393737"><?= $Nombre ?></h2>
        <h3 class="mt-2 text-lg font-bold text-H_393737">No. Control: <?= $NoControl ?></h3>
        <span class="px-2 py-1 text-sm text-black rounded"><?= $Rol ?></span>
        <div class="flex items-center justify-center mt-2 space-x-2">
            <a href="<?= $Github ?>" target="_blank" class="flex items-center space-x-2 font-medium text-gray-600">
                <span class="text-xl mdi mdi-github"></span>
                <span>Perfil GitHub</span>
            </a>
        </div>
    </div>
</div>