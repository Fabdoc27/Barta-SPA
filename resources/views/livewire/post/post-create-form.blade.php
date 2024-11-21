<form wire:submit.prevent="save" class="px-4 py-5 mx-auto space-y-6 bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6" x-data="imagePreview()">
    <div class="flex space-x-3">
        {{-- User Avatar --}}
        <div class="flex-shrink-0">
            <img class="mt-1 rounded-full size-10" src="{{ auth()->user()->get_avatar }}" alt="{{ auth()->user()->name }}" />
        </div>

        <div class="flex-1">
            {{-- Image Preview --}}
            <div class="relative flex items-center justify-center" x-show="imagePreview" x-cloak>
                <img x-bind:src="imagePreview" class="object-cover w-full mb-4 rounded-lg min-h-auto max-h-64 md:max-h-72" alt="Post Image Preview" />

                {{-- Button to Remove Image --}}
                <x-cross-button wire:click="clearImage" @click="removeImage()" />
            </div>

            {{-- Content --}}
            <div class="w-full font-normal text-gray-700">
                <x-input-textarea wire:model="content" rows="4" placeholder="What's going on, {{ auth()->user()->name }}?"
                    :hasError="$errors->has('content')">{{ old('content') }}</x-input-textarea>

                @if ($errors->any())
                    <x-validation-error :messages="$errors->all()" />
                @endif
            </div>
        </div>
    </div>

    {{-- Create Post Card Bottom --}}
    <div class="flex items-center justify-between">
        <div class="flex gap-4 text-gray-600">
            {{-- Upload Picture Button --}}
            <div>
                <x-input-field type="file" wire:model="image" id="picture" class="hidden" x-ref="pictureInput" @change="previewImage($event)" />

                <x-post-image-label for="picture">
                    <span class="sr-only">Upload Image</span>
                </x-post-image-label>
            </div>
        </div>

        <x-primary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed">
            <span wire:loading>Uploading...</span>
            <span wire:loading.remove>Post</span>
        </x-primary-button>
    </div>
</form>

<script>
    function imagePreview() {
        return {
            imagePreview: null,

            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    this.imagePreview = URL.createObjectURL(file);
                }
            },

            removeImage() {
                this.imagePreview = null;
                this.$refs.pictureInput.value = null;
            }
        }
    }
</script>
