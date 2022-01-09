<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BCLO') }}</title>

    <!-- Scripts -->
    <script src="{{asset('js/jquery-2.1.3.min.js')}}"></script>
    <script src="{{asset('assets/js/materialize.min.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">


    <!-- Styles -->


    <link href="{{asset('assets/css/materialize.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">


</head>

<body>
    <div id="app">
        <!--NAVBAR-->
        @include('includes.nav')
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        @yield('content')
                        @yield('scripts')
                    </div>
                </div>
            </div>



        </main>

    </div>

    <script src="{{asset('js/toastr.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        @if(Session::has('success'))
        toastr.success("{{Session::get('success')}}")
        @endif
    </script>

    <script>
        @if(Session::has('info'))
        toastr.info("{{Session::get('info')}}")
        @endif
    </script>

    <script>
        @if(Session::has('warning'))
        toastr.warning("{{Session::get('warning')}}")
        @endif
    </script>
</body>

</html>