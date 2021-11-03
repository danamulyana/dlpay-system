<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" href="{{ asset('dist/images/logo.svg') }}" type="image/x-icon">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/line-awesome.min.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="main">
        <div class="flex">
            @livewire('component.side-menu')
            <!-- BEGIN: Content -->
            <div class="content">
                {{-- @include('../layout/components/top-bar') --}}
                @livewire('component.top-bar')
                {{ $slot }}
            </div>
            <!-- END: Content -->
        </div>
        @livewireScripts

        <x-livewire-alert::scripts />
    </body>
</html>