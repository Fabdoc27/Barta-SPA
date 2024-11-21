<div class="w-1/3 py-2 md:ml-24">
    <div class="relative">
        <form class="w-full mx-auto mb-3">
            <label class="text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>

                <input wire:model.live.debounce="word" type="search"
                    class="block w-full px-2 py-3 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-gray-700 focus:border-gray-700"
                    placeholder="Search ..." required />

                <button wire:click.prevent="clear" {{ empty($word) ? 'disabled' : '' }}
                    class="absolute px-4 py-1 text-sm font-medium text-white bg-gray-900 border rounded-lg end-2 bottom-2 hover:bg-gray-100 hover:text-gray-900 hover:border-gray-900 focus:outline-none">Clear</button>
            </div>
        </form>

        @if (!empty($word))
            <div wire:transition.duration.500ms class="absolute w-full p-4 space-y-3 bg-gray-100 border rounded-md">
                @forelse ($results as $result)
                    <div wire:key="{{ $result->id }}" class="border-2 border-gray-600 rounded-md bg-gray-300/75">
                        <div class="p-2 hover:cursor-pointer" wire:click="selectUser({{ $result->id }})">
                            <p>{{ $result->name }}</p>
                            <p class="text-sm"> {{ '@' . $result->username }}</p>
                        </div>
                    </div>
                @empty
                    <span>No results found</span>
                @endforelse
            </div>
        @endif
    </div>
</div>
