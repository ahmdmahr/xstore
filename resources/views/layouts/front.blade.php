<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">

    {{-- Owl Carousel --}}
    <link href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.theme.default.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />


    <style>
        a{
            text-decoration: none;
        }
    </style>


</head>
<body>

    @include('layouts.frontend.navbar')

    <div class="content">
        @yield('content')
    </div>
    
    <div class="whatsapp-chat">
        <a href=" https://wa.me/201072640985?text=I'm%20interested%20in%20your%20car%20for%20sale" target="_blank">
            <img src="{{asset('assets/images/whatsapp.png')}}" alt="whatsapp icon" height="80px" width="80px">
        </a>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}" ></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" ></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}" ></script>
    <script src="{{ asset('frontend/js/custom.js') }}" ></script>

    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>

    <script>
        $.ajax({
                method: "GET",
                url: 'product-list',
                success: function(response) {
                    console.log(response);
                    $( "#search_product" ).autocomplete({
                      source: response
                    });
                }
        });
        
    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif

    @yield('scripts')

</body>
</html>
