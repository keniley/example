<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} | Admin</title>
        <meta name="robots" content="noindex,nofollow,nosnippet">
        <!-- Layout css -->
        <link rel="stylesheet" href="/dist/admin/css/vendor.css">
        <link rel="stylesheet" href="/dist/admin/css/admin.css">
        @yield('css')
    </head>

    <body class="min-vh-100 h-100 d-flex flex-column align-items-stretch">
        <header class="d-flex">
            <div class="nav p-2 justify-content-between bg-gray-800 d-none-under-800 d-flex-navigation-open">
                <a href="/admin" class="position-relative app-logo">
                    <img src="data:image/png;base64,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">
                    <div class="text-white position-absolute size-0-8" style="left: 32px;top: 13px;">Avantina</div>
                </a>
                <div id="menu-toggler" class="d-none-under-800">
                    <div></div>
                </div>
            </div> 
            <nav class="p-2">
                @include('admin.layout.topnav')
            </nav>
        </header>
        <div id="page" class="d-flex flex-row flex-grow-1">
            <nav class="nav bg-gray-800 d-none-under-800 d-flex-navigation-open">
                @include('admin.layout.menu')
            </nav>
            <div class="container-fluid p-3 bg-gray-100" id="content">
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div><i class="fas fa-exclamation-triangle d-inline-block mr-2"></i><span>{{ $error }}</span></div>
                        @endforeach
                    </div>
                @endif

                @yield('content')
                @include('admin.layout.modal')
            </div>
        </div>


        <script src="/dist/admin/js/vendor.js"></script>
        <script src="/dist/admin/js/app.js"></script>
        @yield('javascript')
    </body>
</html>