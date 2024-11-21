<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Update Profile Avatar</h2>
        <p class="mt-1 text-sm text-gray-600">
            Keep your profile picture up-to-date so that our users can easily find you across the site!
        </p>
    </header>

    <form class="mt-6" wire:submit.prevent="uploadAvatar">
        <div class="col-span-full">
            <div class="flex items-center mt-2 gap-x-2">
                <div class="relative">
                    <img class="object-cover w-16 h-16 rounded-full ring-2 ring-gray-300" src="{{ $avatar ? $avatar->temporaryUrl() : $existingAvatar }}" alt="{{ $user->name }}" />
                </div>

                <label for="avatar">
                    <div
                        class="inline-flex items-center px-4 py-2 ml-3 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Choose
                    </div>
                </label>

                <x-input-field type="file" wire:model="avatar" id="avatar" class="hidden" />

                <button type="submit" wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:loading.attr="aria-disabled:true"
                    wire:loading.remove.attr="aria-disabled:false"
                    class="inline-flex items-center px-4 py-2 ml-3 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <span wire:loading>Uploading ...</span>
                    <span wire:loading.remove>Update</span>
                </button>
            </div>

            <x-validation-error :messages="$errors->get('avatar')" />
        </div>
    </form>

    <div class="mt-6">
        <form wire:submit="deleteAvatar">
            <button
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Delete Current Avatar
            </button>
        </form>
    </div>
</section>
