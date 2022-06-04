@extends('layouts.main')

@section('content')

<!-- Main Content Here -->
<div class="main_content">
        <div class="breadCrumbs">
        <p class="breadCrumbs_heading">Home</p>
        @if(!empty(session()->has('message')))
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="success-alert">
  <strong>Error!</strong> {{ session()->get('message') }}.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
        </div>
        <div class="form_div_home">
          <h3>Select the Details</h3>

            <div class="form_div w-100">
              <form class="form" id="adminForm" method="POST" action="{{ route('dataListing')}}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-12">
                    <label for="inputState" class="font-weight-bold">Position</label>
                    <select id="position" name ="position" class="form-control">
                      <!-- <option selected value="null">Choose...</option> -->
                      <option selected value='{{$getUserPosition}}'>{{$getUserPosition}}</option>
                      <!-- @foreach ($positons as $positon)
                        <option value="{{$positon->position_val}}">{{$positon->position_val}}</option>
                        
                      @endforeach -->
                     
                    </select>
                  </div>
                  @error('position')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-row">
                <div class="form-group col-6">
                    <label for="provincia" class="font-weight-bold">Provincia</label>
                    <select id="provincia" name ="provincia" class="form-control">
                      <option disabled selected>Choose...</option>
                      @foreach ($getSTatVal as $val)
                      <option {{ $val->state_name == $user->state ? 'selected' :''}}  value="{{$val['state_name']}}">{{$val['state_name']}}</option>
                      @endforeach
                    </select>

                    @error('provincia')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                  <div class="form-group col-6">
                    <label for="canton" class="font-weight-bold">Canton</label>
                    <select id="canton" name ="canton" class="form-control">
                    <option selected value="{{$user['city']}}">{{$user['city']}}</option>
                      
                    </select>
                    @error('canton')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-6">
                    <label for="parroquia" class="font-weight-bold">Parroquias</label>
                    <select id="parroquia" name ="parroquia" class="form-control">
                      <!-- <option selected disabled>Choose...</option> -->
                      <option selected value="{{$user['parroquia']}}">{{$user['parroquia']}}</option>
                      <!-- <option value="parroquia">Parroquia</option> -->
                    </select>
                    @error('parroquia')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                  <div class="form-group col-6">
                    <label for="zona" class="font-weight-bold">Zone</label>
                    <select id="zona" name ="zona" class="form-control">
                      <option selected disabled>Choose...</option>
                      <!-- <option value="zona">Zone</option> -->
                    </select>
                    @error('zona')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group col-6">
                    <label for="circun" class="font-weight-bold">Circunscripcion</label>
                    <select id="circun" name ="circun" class="form-control">
                      <option selected disabled>Choose...</option>
                      <option value="U">URBANO</option>
                      <option value="R">RURAL</option>
                      <option value="E">EXTERIOR</option>
                    </select>
                    @error('circun')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group col-6">
                    <label for="junta_no" class="font-weight-bold">Junta No</label>
                    <select id="junta_no" name ="junta_no" class="form-control">
                      <option selected disabled>Choose...</option>
                      <!-- <option value="junta_no">Junta</option> -->
                    </select>
                    @error('junta_no')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
               
                <input type="submit" class="btn  float-right comon_color_btn submit_btn" value="Next" >
              </form>
          </div>
        </div>


      </div>

    </div>

@endsection('content')

@section('javascript')
<script>

$(document).ready(function(){
                $('select[name=provincia]').on('change', function() {
                    var getPositionValu = "{{$user['city']}}";
                    console.log(getPositionValu);
                    var getValueOption = this.value;
                    $.ajax({
                        type: "POST",
                        url: "{{ route('getcityval')}}",
                        data: {
                        'getValueOption': getValueOption
                        },
                        success: function(result) {
                            var selectedCity =  '';
                            html = '<option value="null">Choose...</option>';
                            $.each(result.data, function( index, value ) {
                                if(getPositionValu == value.city_name)
                                {   
                                    // selectedCity = 'selected';

                                }
                                html += '<option '+selectedCity+'  value="'+value.city_name+'">'+value.city_name+'</option>';
                                selectedCity ='';
                            });

                          console.log(html);
                          // debugger;
                            $('select[name=canton]').html(html);


                        },
                        error: function() {
                        alert("Error");
                        }
                    });
                });
                $('select[name=canton]').on('change', function() {
                    var getPositionValu = "{{$user['parroquia']}}";
                    console.log(getPositionValu);
                    var getValuecity = this.value;
                    var getValueState = $('select[name=provincia] option:selected').val();

                    // $.LoadingOverlay("show");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('getparroquiaval')}}",
                        data: {
                        'getValuecity': getValuecity,
                        'getValueState': getValueState,
                        },
                        success: function(result) {
                            var selectedCity =  '';
                        // $.LoadingOverlay("hide");
                            html = '<option value="null">Choose...</option>';
                            
                            $.each(result.data, function( index, value ) {
                                if(getPositionValu == value.parroquia_name)
                                {   
                                    // selectedCity = 'selected';

                                }
                                html += '<option '+selectedCity+' value="'+ value.parroquia_name +'">' + value.parroquia_name +'</option>';
                                selectedCity ='';
                            });
                            $('select[name=parroquia]').html(html);
                            $('select[name=parroquia]').removeAttr('disabled');


                        },
                        error: function() {
                        alert("Error");
                        }
                    });
                });
                $('select[name=parroquia]').on('change', function() {
                    var getValueparroquia = this.value;
                    var getValueState = $('select[name=provincia] option:selected').val();
                    var getValueCanton = $('select[name=canton] option:selected').val();
                    // $.LoadingOverlay("show");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('getZonaValue')}}",
                        data: {
                        'getValuecity': getValueCanton,
                        'getValueState': getValueState,
                        'getValueparroquia': getValueparroquia,
                        },
                        success: function(result) {
                        // $.LoadingOverlay("hide");
                        console.log(result.data[0].zone_name);
                        var selectedCity ='';
                        if(result.data[0].zone_name == 'null' || result.data[0].zone_name == null)
                        {
                            html = "<option  value='null'>Empty</option>";
                            console.log(html);
                            $('select[name=zona]').html(html);
                        }
                        else{
                            var html = '<option value="null">Choose...</option>';
                            $.each(result.data, function( index, value ) {
                                // if(getPositionValu == value.zone_name)
                                // {   
                                //     console.log('inside ifsas ');
                                //     selectedCity = 'selected';

                                // }
                                html += '<option '+selectedCity+' value="'+ value.zone_name +'">' + value.zone_name +'</option>';
                                selectedCity='';
                            });
                            $('select[name=zona]').html(html);

                        }

                            $('select[name=zona]').removeAttr('disabled');


                        },
                        error: function() {
                        alert("Error");
                        }
                    });
                });
                // $('select[name=zona]').on('change', function() {
                //     $('select[name=circun]').empty();
                //     var UrbanoValue ='';
                //     var RuralValue ='';
                //     var ExteriorValue ='';
                //     console.log(getcicunCurrentValue);
                //     // if(getcicunCurrentValue =='U')
                //     // {
                //     //     UrbanoValue = 'selected';
                //     // }
                //     // if(getcicunCurrentValue =='R')
                //     // {
                //     //     RuralValue = 'selected';
                //     // }
                //     // if(getcicunCurrentValue =='E')
                //     // {
                //     //     ExteriorValue= 'selected';
                //     // }
                //     var CircunOPtion = `<option value="null">Choose...</option>
                //                         <option  value="U">URBANO</option>
                //                         <option   value="R">RURAL</option>
                //                         <option value="E">EXTERIOR</option>`;
                //     $('select[name=circun]').html(CircunOPtion);
                //     // circunValue='';
                //     });
                    // $('select[name=circun]').on('change', function() {
                    //     var getValuecircun    = this.value;
                    //     var getValueState     = $('select[name=provincia] option:selected').val();
                    //     var getValueCanton    = $('select[name=canton] option:selected').val();
                    //     var getValueparroquia = $('select[name=parroquia] option:selected').val();
                    //     var getValuezona      = $('select[name=zona] option:selected').val();
                    //     // $.LoadingOverlay("show");
                    //     $.ajax({
                    //         type: "POST",
                    //         url: "{{ route('getJuntaValue')}}",
                    //         data: {
                    //         'getValuecircun': getValuecircun,
                    //         'getValueState': getValueState,
                    //         'getValueCanton': getValueCanton,
                    //         'getValuezona': getValuezona,
                    //         'getValueparroquia': getValueparroquia,
                    //         },
                    //         success: function(result) {
                    //         // $.LoadingOverlay("hide");
                    //         var femaleVal='';
                    //         var maleVal='';
                    //         var femaleVoter = (result.data[0].female_tables) ?result.data[0].female_tables : null;
                    //         var MaleVoter = result.data[0].male_tables;
                    //         var html ='<option value="null">Choose...</option>';
                    //         for (let i = 1; i <= femaleVoter; i++) {
                    //                 // if(junta_no == i+'F')
                    //                 // {
                    //                 //     femaleVal ='selected';

                    //                 // }
                    //                 html += '<option  value="'+ i+'F'+'">' + i+'F' +'</option>';
                    //                 femaleVal='';
                    //             }
                    //             $('select[name=junta_no]').empty();
                    //             $('select[name=junta_no]').append(html);

                    //         var Malehtml = "";
                    //         for (let i = 1; i <= MaleVoter; i++) {
                                
                    //             Malehtml += '<option   value="'+ i+'M'+'">' + i+'M' +'</option>';
                    //             maleVal ='';
                    //             }
                    //             // $('select[name=junta_no]').empty()
                    //             $('select[name=junta_no]').append(Malehtml);
                    //             // $.each(result.data, function( index, value ) {
                    //             // });
                    //             $('select[name=junta_no]').removeAttr('disabled');


                    //         },
                    //         error: function() {
                    //         alert("Error");
                    //         }
                    //     });
                    //     });
  $('select[name="circun"],select[name="junta_no"]').attr('disabled','disabled');  
    $('select[name=zona]').on('change', function() {
      $('select[name=circun]').removeAttr('disabled');

    });

    $('select[name=circun]').on('change', function() {
      var getValuecircun    = this.value;
      var getValueState     = $('select[name=provincia] option:selected').val();
      var getValueCanton    = $('select[name=canton] option:selected').val();
      var getValueparroquia = $('select[name=parroquia] option:selected').val();
      var getValuezona      = $('select[name=zona] option:selected').val();

      // $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: "{{ route('getJuntaValue')}}",
        data: {
          'getValuecircun': getValuecircun,
          'getValueState': getValueState,
          'getValueCanton': getValueCanton,
          'getValuezona': getValuezona,
          'getValueparroquia': getValueparroquia,
        },
        success: function(result) {
           // $.LoadingOverlay("hide");
           console.log(result.data.length);
           if(result.data.length == 0)
           {
            var htmls ='<option value="null">Empty</option>';
            $('select[name=junta_no]').empty();
            $('select[name=junta_no]').append(htmls);

           }
           else{

           var femaleVoter = result.data[0].female_tables;
           console.log(femaleVoter);
           var MaleVoter = result.data[0].male_tables;
           var html ='<option value="null">Choose...</option>';
           for (let i = 1; i <= femaleVoter; i++) {
                html += '<option  value="'+ i+'F'+'">' + i+'F' +'</option>';
            }
            $('select[name=junta_no]').empty();
            $('select[name=junta_no]').append(html);

          var Malehtml ='';
           for (let i = 1; i <= MaleVoter; i++) {
              Malehtml += '<option  value="'+ i+'M'+'">' + i+'M' +'</option>';
            }
            // $('select[name=junta_no]').empty();
            $('select[name=junta_no]').append(Malehtml);
            // $.each(result.data, function( index, value ) {
            // });
            $('select[name=junta_no]').removeAttr('disabled');
          }


        },
        error: function() {
          alert("Error");
        }
      });
    });
});
</script>
@endsection('javascript')
