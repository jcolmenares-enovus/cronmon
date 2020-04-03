<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/cronmon.css" rel="stylesheet">
    @notifyCss
    

    <link rel="shortcut icon" href="/favicon.ico">
    <!-- Scripts -->
    <script>
        window.Laravel = @json(['csrfToken' => csrf_token()])
    </script>
    @livewireStyles
</head>
<body class="bg-grey-lightest">
    <div id="app">

        @include('partials.navbar')

        <div class="container mx-auto pt-8 mb-16">
                @include('partials.errors')
                @if(Session::has('success-message'))
                    <div class="bg-green-lightest border border-green text-green px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Horray!</strong>
                        <span class="block sm:inline">{{ Session::get('success-message') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </div>
                @endif

                @if(Session::has('error-message'))
                    <div class="bg-red-lightest border border-red text-red px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Horray!</strong>
                        <span class="block sm:inline">{{ Session::get('success-message') }}</span>
                    </div>
                @endif

                @yield('content')
        </div>

    </div>

    <script src="/js/app.js"></script>
    @include('notify::messages')
    @notifyJs
    @livewireScripts
</body>
</html>
