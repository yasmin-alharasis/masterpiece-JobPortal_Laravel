<!DOCTYPE html>
<html>
<head>
    <title></title>
    @include('../partials.head')
</head>

<body>

    @include('../partials.nav')
    @yield('content')
    @include('../partials.footer')
    
</body>

</html>
