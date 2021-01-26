<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('admin.includes.main_css')
    @stack('add-style')
</head>
<body style="background: #f8fafc">

@include('admin.includes.navbar')
<div class="container-fluid mt-8">
    @yield('content')
</div>

@include('admin.includes.main_js')

@routes
@stack('add-script')
</body>
</html>
