<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/bootstrap.min.js')}}">

    <title>@yield('title')</title>
</head>
<body>
    @include('parts.header')
    
    <main class="py-5">
        <div class="container">
            
                <div class="col-12">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            
        </div>
    </main>

    @include('parts.footer')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <Script src="{{asset('assets/js/bootstrap.min.js')}}"></Script>
    {{-- <Script src="{{asset('assets/client/js/custom.js')}}"></Script> --}}
    @stack('scripts')
</body>
</html>