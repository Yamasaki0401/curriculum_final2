<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md bg-secondary shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('top') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     @include('layouts.navbar')
                </div>
            </div>
        </nav>

        <div class="container">
                <div class="row">
                    <aside class="py-4 col-md-2 col-12 border-end border-3 d-none d-md-block">
                        @include('layouts.sidebar')
                    </aside>
                    <main class="col-md-10 col-12 px-4" style="margin-top: 80px;">
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </main>
                    <footer class="bg-light text-center py-3 border-top border-2">
                        <p>© 2025 あなたのご近所さん. All rights reserved.</p>
                </footer>
                </div>
        </div>
    </div>
</body>
</html>
