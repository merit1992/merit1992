<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        /* these styles will animate bootstrap alerts. */
        .alert {
            z-index: 99;
            top: 60px;
            right: 18px;
            min-width: 30%;
            position: fixed;
            animation: slide 0.5s forwards;
        }

        @keyframes slide {
            100% {
                top: 30px;
            }
        }

        @media screen and (max-width: 668px) {
            .alert {
                /* center the alert on small screens */
                left: 10px;
                right: 10px;
            }
        }
    </style>
</head>

<body>
    <div id="app">

        @include('inc.navbar')

        <main class="py-4">
            @yield('content')
        </main>


        {{-- Success Alert --}}
        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        {{-- Error Alert --}}
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <script>
            //close the alert after 3 seconds.
       
        window.addEventListener('load', function(){
            let al = document.querySelector('.alert');            
            setTimeout(function() {
                (al) ? (al.style.display = "none") : '';                
            }, 3000);
    	});

        // $(document).ready(function(){
	    // setTimeout(function() {
	    //     $(".alert").alert('close');
	    // }, 3000);
    	// });
        
        </script>

    </div>
</body>

</html>