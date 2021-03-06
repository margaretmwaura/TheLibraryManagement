<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.8.95/css/materialdesignicons.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cytonn Libraries') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div id="root">
    <admin-template>
        @yield('content')
    </admin-template>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
    @auth
        window.perm = {!! json_encode(Auth::user()->role->permissions->pluck('name'), true) !!};
    console.log("The permissions gotten ",window.perm);
    @else
        window.perm = [];
    @endauth
</script>
</body>
</html>
