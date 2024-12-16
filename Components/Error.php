<div class="mb-4 relative w-full flex flex-wrap items-center justify-center py-3 pl-4 pr-14 rounded-lg text-base font-medium transition-all duration-500 ease-out border-solid border border-[#f85149] text-[#b22b2b] [&amp;_svg]:text-[#b22b2b] group bg-[linear-gradient(#f851491a,#f851491a)]">
    <button
        type="button"
        aria-label="close-error"
        class="hidden absolute right-4 p-1 rounded-md transition-opacity text-[#f85149] border border-[#f85149] opacity-40 hover:opacity-100">
        <svg
            stroke="currentColor"
            fill="none"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke-linecap="round"
            stroke-linejoin="round"
            height="16"
            width="16"
            class="sizer [--sz:16px] h-4 w-4">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
        </svg>
    </button>
    <p class="flex flex-row items-center mr-auto text-sm gap-x-2">
        <span class="text-xl mdi mdi-alert-circle-outline"></span>
        <?= $Error ?>
    </p>
</div>