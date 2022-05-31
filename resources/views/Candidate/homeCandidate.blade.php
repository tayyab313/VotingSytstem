@extends('layouts.main')

@section('content')

<!-- Main Content Here -->
<div class="main_content">
        <div class="breadCrumbs">
        <p class="breadCrumbs_heading">Home</p>
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
                      <option selected value="null">Choose...</option>
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
                      <option value="{{$val['state_name']}}">{{$val['state_name']}}</option>
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
                      <option selected disabled>Choose...</option>
                      
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
                      <option selected disabled>Choose...</option>
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
  $('select[name="canton"],select[name="parroquia"],select[name="zona"],select[name="circun"],select[name="junta_no"]').attr('disabled','disabled');  
    $('select[name=provincia]').on('change', function() {
      var getValueOption = this.value;
      // $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: "{{ route('getcityval')}}",
        data: {
          'getValueOption': getValueOption
        },
        success: function(result) {
          // $.LoadingOverlay("hide");
          var html ='<option value="null">Choose...</option>';
            $.each(result.data, function( index, value ) {
                html += '<option  value="'+ value.city_name +'">' + value.city_name +'</option>';
            });
            $('select[name=canton]').html(html);
            $('select[name=canton]').removeAttr('disabled');


        },
        error: function() {
          alert("Error");
        }
      });
    });

    $('select[name=canton]').on('change', function() {
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
           // $.LoadingOverlay("hide");
           var html ='<option value="null">Choose...</option>';
            $.each(result.data, function( index, value ) {
                html += '<option  value="'+ value.parroquia_name +'">' + value.parroquia_name +'</option>';
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
           var html ='<option value="null">Choose...</option>';
           if(result.data[0].zone_name == 'null' || result.data[0].zone_name == null)
           {
             console.log('inside if ');
            html = "<option  value='null'>Empty</option>";
            console.log(html);
            $('select[name=zona]').html(html);
           }
           else{
            $.each(result.data, function( index, value ) {
                html += '<option  value="'+ value.zone_name +'">' + value.zone_name +'</option>';
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
           var femaleVoter = (result.data[0].female_tables) ?result.data[0].female_tables : null;
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


        },
        error: function() {
          alert("Error");
        }
      });
    });
});
</script>
@endsection('javascript')
