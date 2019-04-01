<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
<!--     <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }} "></script>
    <script src="{{ asset('js/app.js') }}" ></script> 
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stack('scripts')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


<script type="text/javascript">

    $( document ).ready(function() {
        $('#display').keypress(function(event){
            
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                event.preventDefault();
                calc();
                return false; 

            }

        });
    });

    var logArray = [];
    function calc(){
        
        var input = calculator.display.value;
        calculator.display.value = eval(calculator.display.value);

        $("#log").append("Your input was = " + input + " and output is ="+calculator.display.value + "</br>");
        var log={
            'input': input,
            'output': calculator.display.value
        }
        


        if($("#display").val() && $("#display").val() != "Infinity" && $("#display").val() != "undefined"){
           logArray.push(log);
        }else{
            return false;
        }
    }

    function saveLog(){
        if(logArray.length != 0){
            if($("#logName").val() == ""){
                alert("Please enter Log name");
                return false;
            }else{
                $.ajax({
                    url: "{{route('calculatorPost')}}",
                    type: "POST",
                    data:{"logArray":logArray,"_token": "{{ csrf_token() }}","logName":$("#logName").val()},
                    dataType: "json",
                    success: function(response){
                        if(response.code == 100){
                           $("#status").html("Successfully saved the log.");
                           $("#log").html("");
                           logArray = [];   
                            $("#display").val("");
                        }
                    },
                    error: function (jqXHR, exception) {
                        $("#status").html("Unable to save the log.");
                    }
                });
            }   
        }else{
            alert("Can not save the log. Please refresh and try again.")
        }
    }

    function clearLog(){
            $("#log").html("");
            logArray = [];
            $("#status").html("Log has been cleared.");
            $("#display").val("");
    }
</script>
</body>
</html>
