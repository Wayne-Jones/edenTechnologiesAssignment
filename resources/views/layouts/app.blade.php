<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>{{ config('app.name') }}</title>
    </head>
    <body>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p=0">
            <a class="navbar-brand col-sm-3 col-md-3 mr-0" href="/">{{ config('app.name') }}</a>
        </nav>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/datatables">DataTables</a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" href="/vis">Vis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/chartjs">Chart.JS</a>
                        </li>
                    </ul>
                </div>      
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-4">
                
                @yield('content')

            </main>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>

    @yield('additionalScripts')

    </body>
</html>