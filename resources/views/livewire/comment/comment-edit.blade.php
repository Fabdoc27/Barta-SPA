<div>
    @if ($isModalOpen)
        {{-- Edit Modal --}}
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-75">
            <div class="w-full max-w-lg p-6 bg-white rounded shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold">Edit Comment</h2>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="updateComment">
                    <div>
                        <x-input-textarea wire:model="content" placeholder="Update your comment..." rows="1"></x-input-textarea>

                        <x-validation-error :messages="$errors->get('content')" />
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end gap-4 mt-4">
                        <button type="button" wire:click="closeModal" class="text-sm font-semibold text-gray-900">
                            Cancel
                        </button>
                        <x-primary-button>Update</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
