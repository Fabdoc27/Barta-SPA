<form wire:submit.prevent="save" class="px-4 py-5 mx-auto space-y-6 bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6" x-data="imageUpdate(@entangle('removeExistingImage'), {{ $post->image ? 'true' : 'false' }})">

    <div class="flex space-x-3">
        {{-- User Avatar --}}
        <div class="flex-shrink-0">
            <img class="mt-4 rounded-full size-10" src="{{ auth()->user()->get_avatar }}" alt="{{ auth()->user()->name }}" />
        </div>

        <div class="flex-1">
            <div class="relative flex items-center justify-center mb-4">
                {{-- Show current image if available --}}
                <template x-if="!imagePreview && hasExistingImage">
                    <img src="{{ asset('storage/' . $post->image) }}" class="object-cover w-full rounded-lg max-h-64 md:max-h-72" alt="Post Image">
                </template>

                {{-- Show preview of the newly uploaded image --}}
                <template x-if="imagePreview">
                    <img :src="imagePreview" class="object-cover w-full rounded-lg max-h-64 md:max-h-72" alt="Post Image Preview">
                </template>

                <x-cross-button x-show="imagePreview || hasExistingImage" x-cloak @click="removeImage()" />
            </div>

            {{-- Remove Image Button --}}
            <input type="hidden" wire:model="removeExistingImage">

            {{-- Content --}}
            <div class="w-full font-normal text-gray-700">
                <x-input-textarea wire:model="content" rows="3" :hasError="$errors->has('content')"></x-input-textarea>

                @if ($errors->any())
                    <x-validation-error :messages="$errors->all()" />
                @endif
            </div>
        </div>
    </div>

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
            <span wire:loading.remove>Update Post</span>
        </x-primary-button>
    </div>
</form>

<script>
    function imageUpdate(removeExistingImage, hasExistingImage) {
        return {
            imagePreview: null,
            hasExistingImage: hasExistingImage,
            removeExistingImage: removeExistingImage,

            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    this.imagePreview = URL.createObjectURL(file);
                    this.hasExistingImage = false;
                    this.removeExistingImage = false;
                }
            },

            removeImage() {
                this.imagePreview = null;
                this.removeExistingImage = true;
                this.$refs.pictureInput.value = null;
                this.hasExistingImage = false;
            }
        };
    }
</script>
