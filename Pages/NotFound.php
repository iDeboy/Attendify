<div class="w-screen h-screen bg-H_EBF3F0 flex items-center justify-center">
    <div class="text-center">
        <div class="relative inline-block mb-6">
            <img 
                class="h-40 w-40 object-cover rounded-full border-4 border-H_519d71"
                src="assets/img/pageerror.png" 
                alt="Error Icon">
            <div class="absolute inset-0 rounded-full shadow-inner"></div>
        </div>
        <h1 class="text-4xl font-bold text-H_393737 mb-4">Recurso no encontrado</h1>
        <p class="text-H_618762 text-lg mb-6">{{ .not_found }}</p>
        <button 
            class="boton w-40 py-2 rounded-md hover:bg-H_38813B transition-all" >
            Regresar
        </button>
    </div>
</div>