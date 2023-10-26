<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<body>

    

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
@include('layouts.navbar')
@include('layouts.sidebar')

 @yield('section')


 
@include('layouts.scripts')
@include('layouts.footer')
</body>
</html>