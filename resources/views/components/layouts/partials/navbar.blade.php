<nav x-data="{ mobileMenuOpen: false, userMenuOpen: false }" class="bg-white shadow">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" wire:navigate>
                    <h2 class="text-2xl font-bold">Barta</h2>
                </a>
            </div>

            {{-- Search --}}
            <livewire:search-bar />

            <div class="space-x-6 sm:ml-6 sm:flex sm:items-center">
                <a href="{{ route('posts.create') }}" wire:navigate
                    class="text-gray-900 hover:text-white border-2 border-gray-800 hover:bg-gray-900 focus:ring-2 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hidden md:block">
                    Create Post
                </a>

                {{-- Profile dropdown  --}}
                <div class="relative ml-3" x-data="{ open: false }">
                    {{-- User Avatar --}}
                    <div>
                        <button @click="open = !open" type="button"
                            class="flex text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <span class="sr-only">Open user menu</span>
                            @if (auth()->check())
                                <img class="w-8 h-8 rounded-full" src="{{ $user->get_avatar }}" alt="{{ $user->name }}" />
                            @else
                                <img class="w-8 h-8 rounded-full" src="https://avatars.githubusercontent.com/u/150423186?v=4" alt="Guest User" />
                            @endif
                        </button>
                    </div>

                    {{-- Dropdown menu  --}}
                    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg">
                        @if (auth()->check())
                            {{-- wire:navigate --}}
                            <x-nav-link href="{{ route('profile.index', $user->username) }}" wire:navigate>Your Profile</x-nav-link>
                            <x-nav-link href="{{ route('profile.edit', $user->username) }}" wire:navigate>Edit Profile</x-nav-link>
                            <livewire:auth.logout />
                        @else
                            <x-nav-link href="{{ route('login') }}" wire:navigate>Login</x-nav-link>
                            <x-nav-link href="{{ route('register') }}" wire:navigate>Register</x-nav-link>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex items-center -mr-2 sm:hidden">
                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                    class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500">
                    <span class="sr-only">Open main menu</span>

                    <!-- Icon when menu is closed -->
                    <svg x-show="!mobileMenuOpen" class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>

                    <!-- Icon when menu is open -->
                    <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu, show/hide based on menu state.  --}}
    <div x-show="mobileMenuOpen" class="sm:hidden" id="mobile-menu">
        {{-- Profile dropdown  --}}
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="flex items-center px-4">
                {{-- User Avatar --}}
                <div class="flex-shrink-0">
                    @if (auth()->check())
                        <img class="w-8 h-8 rounded-full" src="{{ $user->get_avatar }}" alt="{{ $user->name }}" />
                    @else
                        <img class="w-8 h-8 rounded-full" src="https://avatars.githubusercontent.com/u/150423186?v=4" alt="Guest User" />
                    @endif
                </div>
                <div class="ml-3">
                    @if (auth()->check())
                        <h2 class="text-base font-medium text-gray-800">{{ $user->name }}</h2>
                        <p class="text-sm font-medium text-gray-500">{{ $user->email }}</p>
                    @else
                        <div class="text-base font-medium text-gray-800">Ashraful Karim</div>
                        <div class="text-sm font-medium text-gray-500">ashrafulkarim.dev@gmail.com</div>
                    @endif
                </div>
            </div>

            {{-- Dropdown Menu --}}
            <div class="mt-3 space-x-2">
                @if (auth()->check())
                    <x-nav-responsive-link href="{{ route('posts.create') }}" wire:navigate>Create Post</x-nav-responsive-link>
                    <x-nav-responsive-link href="{{ route('profile.index', $user->username) }}" wire:navigate>Your Profile</x-nav-responsive-link>
                    <x-nav-responsive-link href="{{ route('profile.edit', $user->username) }}" wire:navigate>Edit Profile</x-nav-responsive-link>
                    <livewire:logout />
                @else
                    <x-nav-responsive-link href="{{ route('login') }}" wire:navigate>Login</x-nav-responsive-link>
                    <x-nav-responsive-link href="{{ route('register') }}" wire:navigate>Register</x-nav-responsive-link>
                @endif
            </div>
        </div>
    </div>
</nav>
