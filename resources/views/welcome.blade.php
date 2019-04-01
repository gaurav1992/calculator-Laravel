<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calculator</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #container {
                width: 227px;
                padding: 8px 8px 20px 8px;
                margin: 20px auto;
                background-color: #ABABAB;
                border-radius: 4px;
                border-top: 2px solid #FFF;
                border-right: 2px solid #FFF;
                border-bottom: 2px solid #C1C1C1;
                border-left: 2px solid #C1C1C1;
                box-shadow: -3px 3px 7px rgba(0, 0, 0, .6), inset -100px 0px 100px rgba(255, 255, 255, .5);
            }

            #display {
                display: block;
                margin: 15px auto;
                height: 42px;
                width: 174px;
                padding: 0 10px;
                border-radius: 4px;
                border-top: 2px solid #C1C1C1;
                border-right: 2px solid #C1C1C1;
                border-bottom: 2px solid #FFF;
                border-left: 2px solid #FFF;
                background-color: #FFF;
                box-shadow: inset 0px 0px 10px #030303, inset 0px -20px 1px rgba(150, 150, 150, .2);
                font-size: 28px;
                color: #666;
                text-align: right;
                font-weight: 400;
            }

            .button {
                display: inline-block;
                margin: 2px;
                width: 42px;
                height: 42px;
                font-size: 16px;
                font-weight: bold;
                border-radius: 4px;
            }

            .mathButtons {
                margin: 2px 2px 6px 2px;
                color: #FFF;
                text-shadow: -1px -1px 0px #44006F;
                background-color: #434343;
                border-top: 2px solid #C1C1C1;
                border-right: 2px solid #C1C1C1;
                border-bottom: 2px solid #181818;
                border-left: 2px solid #181818;
                box-shadow: 0px 0px 2px #030303, inset 0px -20px 1px #2E2E2E;
            }

            .digits {
                color: #181818;
                text-shadow: 1px 1px 0px #FFF;
                background-color: #EBEBEB;
                border-top: 2px solid #FFF;
                border-right: 2px solid #FFF;
                border-bottom: 2px solid #C1C1C1;
                border-left: 2px solid #C1C1C1;
                border-radius: 4px;
                box-shadow: 0px 0px 2px #030303, inset 0px -20px 1px #DCDCDC;
            }

            .digits:hover,
            .mathButtons:hover,
            #clearButton:hover {
                background-color: #FFBA75;
                box-shadow: 0px 0px 2px #FFBA75, inset 0px -20px 1px #FF8000;
                border-top: 2px solid #FFF;
                border-right: 2px solid #FFF;
                border-bottom: 2px solid #AE5700;
                border-left: 2px solid #AE5700;
            }

            #clearButton {
                color: #FFF;
                text-shadow: -1px -1px 0px #44006F;
                background-color: #D20000;
                border-top: 2px solid #FF8484;
                border-right: 2px solid #FF8484;
                border-bottom: 2px solid #800000;
                border-left: 2px solid #800000;
                box-shadow: 0px 0px 2px #030303, inset 0px -20px 1px #B00000;
            }
        </style>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="">
                        <fieldset id="container">
                            <form name="calculator" method="POST">

                                <input id="display" type="text" name="display" >

                                <input class="button digits" type="button" value="7" onclick="calculator.display.value += '7'">
                                <input class="button digits" type="button" value="8" onclick="calculator.display.value += '8'">
                                <input class="button digits" type="button" value="9" onclick="calculator.display.value += '9'">
                                <input class="button mathButtons" type="button" value="+" onclick="calculator.display.value += ' + '">
                                <br>
                                <input class="button digits" type="button" value="4" onclick="calculator.display.value += '4'">
                                <input class="button digits" type="button" value="5" onclick="calculator.display.value += '5'">
                                <input class="button digits" type="button" value="6" onclick="calculator.display.value += '6'">
                                <input class="button mathButtons" type="button" value="-" onclick="calculator.display.value += ' - '">
                                <br>
                                <input class="button digits" type="button" value="1" onclick="calculator.display.value += '1'">
                                <input class="button digits" type="button" value="2" onclick="calculator.display.value += '2'">
                                <input class="button digits" type="button" value="3" onclick="calculator.display.value += '3'">
                                <input class="button mathButtons" type="button" value="x" onclick="calculator.display.value += ' * '">
                                <br>
                                <input id="clearButton" class="button" type="button" value="C" onclick="calculator.display.value = ''">
                                <input class="button digits" type="button" value="0" onclick="calculator.display.value += '0'">
                                <input class="button mathButtons" type="button" value="=" onclick="calc();">
                                <input class="button mathButtons" type="button" value="/" onclick="calculator.display.value += ' / '">
                            </form>
                        </fieldset>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="">
                        @if(Auth::check())
                        <div style="text-align: center;">Log name: <input type="text" id="logName" value="" style="" /></div>
                        @endif
                        <div style="height: 300px;width:250px; border: 1px solid black;padding: 8px 8px 20px 8px;margin: 20px auto;overflow: auto;" id="log"></div>
                        <div style="text-align: center;">
                            @if(Auth::check())
                                <button type="button" class="btn" onclick="saveLog()">save</button>
                            @endif
                            <button type="button" class="btn" onclick="clearLog()">clear</button>
                            <p id="status"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                 

        </div>
    </body>
</html>
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }} "></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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