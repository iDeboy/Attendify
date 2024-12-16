<div class="w-full p-1 rounded-lg">
    <form class="flex">
        <div class="flex items-center justify-center w-10 p-1 bg-white border-r border-gray-200 rounded-tl-lg rounded-bl-lg">
            <span class="text-xl pointer-events-none mdi mdi-magnify text-H_393737"></span>
        </div>
        <input type="text"
            class="relative w-full pl-2 text-base bg-white text-H_393737 outline-0 tooltip-trigger"
            placeholder="Buscar . . ."
            <?php if (isset($Value) && $Value !== null): ?>
            value="<?= $Value ?>"
            <?php endif; ?>
            name="<?= $Name ?>">
        <button type="submit" class=" bg-[#779688] p-2 rounded-tr-lg rounded-br-lg text-white font-semibold hover:bg-[#DAE5E0] hover:text-H_618762 transition-colors">
            Buscar
        </button>
    </form>
</div>