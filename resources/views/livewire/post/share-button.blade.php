<div x-data="{ copied: false }" class="relative inline-block">
    <!-- Share Button -->
    <button type="button" class="flex items-center gap-2 p-2 text-xs text-gray-600 rounded-full hover:text-gray-800"
        @click="navigator.clipboard.writeText('{{ $postUrl }}').then(() => { copied = true; setTimeout(() => copied = false, 2000); })">
        <span class="sr-only">Share</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
        </svg>
    </button>

    <!-- Tooltip Message -->
    <div x-show="copied" x-transition:enter="transition ease-out duration-200" x-transition:leave="transition ease-in duration-200" x-cloak
        class="absolute px-2 py-1 text-xs text-white transform translate-x-2 -translate-y-1/2 bg-black rounded shadow top-1/2 left-full" style="white-space: nowrap;">
        Copied to clipboard!
    </div>
</div>
