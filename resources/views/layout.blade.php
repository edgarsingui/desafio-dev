<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CNAB IMPORT</title>
    @yield('css')
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    
</head>
<body class="sidebar-noneoverflow">
    
    <div class="main-container" id="container">

        <div id="content" class="main-content">
            @yield('content')
        </div>
    </div>
    
    
        
    <script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    @yield('js')
    <script src="{{asset('_/axios.js')}}"></script>
</body>
</html>