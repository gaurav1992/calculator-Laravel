@extends('layouts.app')

@section('content')
<div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
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
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
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
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                  <div class="ui-widget">
                    <label for="city">Search Log: </label>
                    <input id="city" >
                  </div>

                  <div class="ui-widget" style="margin-left:2em; font-family:Arial">
                    Log detail:
                    <div id="logddd" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
                  </div>
                </div>
            </div>

        </div>

@endsection

@push('scripts')

<script>
 $( function() {
    var responsArr= [];
    function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#logddd" );
      $( "#logddd" ).scrollTop( 0 );
    }
   jQuery( "#city" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "{{route('calculatorGet')}}",
          dataType: "json",
          data: {
            q: request.term
          },
          success: function( data ) {
            responsArr = data.data
           response( data.data );

          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
       
        // console.log(responsArr);
       
        $.each(responsArr,function(index,value){
            
            if( ui.item.value == value){
                console.log(JSON.parse(index))
                $.each(JSON.parse(index),function(key,val){

                         log( "Your input was : " + val.input + ", And output is = " + val.output);
                });
           
            }
            
        })
       
      }
      
      
    });
  });
</script>
@endpush
