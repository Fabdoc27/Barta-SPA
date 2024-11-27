<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <title>{{ $title ?? 'Page Title' }} | {{ config('app.name', 'Barta') }}</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100" x-data x-on:click=($dispatch('clear-results'))>
    @include('components.layouts.partials.navbar', ['user' => auth()->user()])

    <main class="container max-w-xl min-h-screen px-2 mx-auto mt-8 space-y-6 md:px-0">
        @include('components.layouts.partials.session-message')
        {{ $slot }}
    </main>

    @include('components.layouts.partials.footer')
    @livewireScripts

    @if (auth()->check())
        <script type="module">
            Echo.private(`users.{{ auth()->id() }}`)
                .notification((notification) => {
                    if (notification.type === 'post.liked') {
                        $wire.dispatch('echo-private:users.{{ auth()->id() }},post.liked', notification);
                    } else if (notification.type === 'post.commented') {
                        $wire.dispatch('echo-private:users.{{ auth()->id() }},post.commented', notification);
                    }
                });
        </script>
    @endif

</body>

</html>
