<div class="flex flex-col justify-center min-h-full px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <a href="{{ route('home') }}" wire:navigate class="text-6xl font-bold text-center text-gray-900">
            <h1>Barta</h1>
        </a>
        <h1 class="mt-5 text-2xl font-bold leading-9 tracking-tight text-center text-gray-900">
            Create a new account
        </h1>
    </div>

    <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" wire:submit="register">
            {{-- name --}}
            <div>
                <x-input-label for="name">Full Name</x-input-label>

                <x-input-field wire:model="name" id="name" autocomplete="name" placeholder="Alp Arslan" value="{{ old('name') }}" :hasError="$errors->has('name')" />

                <x-validation-error :messages="$errors->get('name')" />
            </div>

            {{-- username  --}}
            <div>
                <x-input-label for="username">Username</x-input-label>

                <x-input-field wire:model="username" id="username" autocomplete="username" placeholder="alparslan1029" value="{{ old('username') }}" :hasError="$errors->has('username')" />

                <x-validation-error :messages="$errors->get('username')" />
            </div>

            {{-- email --}}
            <div>
                <x-input-label for="email">Email Address</x-input-label>

                <x-input-field type="email" wire:model="email" id="email" autocomplete="email" placeholder="alp.arslan@mail.com" value="{{ old('email') }}"
                    :hasError="$errors->has('email')" />

                <x-validation-error :messages="$errors->get('email')" />
            </div>

            {{-- password --}}
            <div>
                <x-input-label for="password">Password</x-input-label>

                <x-input-field type="password" wire:model="password" id="password" :hasError="$errors->has('password')" placeholder="*****" />

                <x-validation-error :messages="$errors->get('password')" />
            </div>

            {{-- confirm password --}}
            <div>
                <x-input-label for="confirm_password">Confirm Password</x-input-label>

                <x-input-field type="password" wire:model="password_confirmation" id="confirm_password" :hasError="$errors->has('password_confirmation')" placeholder="*****" />

                <x-validation-error :messages="$errors->get('password_confirmation')" />
            </div>

            <div>
                <x-primary-button class="w-full leading-6">Register</x-primary-button>
            </div>
        </form>

        <p class="mt-10 text-sm text-center text-gray-500">
            Already a member?
            <a href="{{ route('login') }}" wire:navigate class="font-semibold leading-6 text-black hover:text-black">Sign In</a>
        </p>
    </div>
</div>
