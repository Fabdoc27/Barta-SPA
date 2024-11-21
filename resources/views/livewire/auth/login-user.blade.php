<div class="flex flex-col justify-center min-h-full px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <a href="{{ route('home') }}" wire:navigate class="text-6xl font-bold text-center text-gray-900">
            <h1>Barta</h1>
        </a>

        <h1 class="mt-10 text-2xl font-bold leading-9 tracking-tight text-center text-gray-900">
            Sign in to your account
        </h1>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" wire:submit="login">
            {{-- email --}}
            <div>
                <x-input-label for="email">Email Address</x-input-label>
                <div class="mt-2">

                    <x-input-field type="email" wire:model="email" id="email" autocomplete="email" placeholder="alp.arslan@mail.com" />

                </div>
                <x-validation-error :messages="$errors->get('email')" />
            </div>

            {{-- password --}}
            <div>
                <x-input-label for="password">Password</x-input-label>

                <x-input-field type="password" wire:model="password" id="password" :hasError="$errors->has('password')" placeholder="*****" />

                <x-validation-error :messages="$errors->get('password')" />
            </div>

            {{-- remember me  --}}
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input type="checkbox" wire:model.boolean="remember" id="remember_me" class="text-gray-600 border-gray-300 rounded shadow-sm">
                    <span class="text-sm text-gray-900 ms-2 ">Remember me</span>
                </label>
            </div>

            <div>
                <x-primary-button class="w-full leading-6">Sign in</x-primary-button>
            </div>
        </form>

        <p class="mt-10 text-sm text-center text-gray-500">
            Don't have an account yet?
            <a href="{{ route('register') }}" wire:navigate class="font-semibold leading-6 text-black hover:text-black">Sign Up</a>
        </p>
    </div>
</div>
