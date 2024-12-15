<div class="flex items-center justify-center w-screen h-screen bg-H_EBF3F0">
    <div class="text-center">
        <div class="relative inline-block mb-6">
            <img
                class="select-none border-H_519d71"
                src="assets/img/pageerror.png"
                alt="Error Icon">
        </div>
        <h1 class="mb-4 text-4xl font-bold text-H_393737"><?= $Error ?></h1>
        <p class="mb-6 text-lg text-H_618762"><?= $Mensaje ?></p>
        <a href="<?= $Regresar ?>"
            class="block w-40 py-2 transition-all rounded-md boton hover:bg-H_38813B">
            Regresar
        </a>
    </div>
</div>