@extends('layouts.main')

@section('content')

 <form action="{{ route('uploadDocumentsave') }}" method="POST" enctype="multipart/form-data" id="uploadDocument">

<div class="main_content">
            
            <div class="container-fluid creat_election_div" style="margin-top: 40px;">


                <div class="heading_create_new_election my-4">
                    <h2>Upload Documents</h2>
                </div>
                <div class="form_div_home">
                    <h3>Position details</h3>

                    <div class="form_div w-100 selection" id="change">
                      
                           @csrf
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="position" class="">Position</label>
                                    <select id="position" class="form-control" name="position">
                                        <option disabled selected >Choose...</option>
                                        @foreach ($positons as $positon)
                                            <option value="{{$positon->position_val}}">{{$positon->position_val}}</option>
                                            
                                        @endforeach
                                    </select>
                                    @error('position')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="provincia" class="">Provinicia</label>
                                    <select id="provincia" class="form-control" name="provincia">
                                        <option disabled selected >Choose...</option>
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
                                    <label for="canton" class="">Canton</label>
                                    <select id="canton" class="form-control" name="canton">
                                        <option disabled selected >Choose...</option>
                                        <option value="canton">provincia</option>
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
                                    <label for="parroquia" class="">Parroquia</label>
                                    <select id="parroquia" class="form-control" name="parroquia">
                                        <option disabled selected >Choose...</option>
                                        <!-- <option value="parroquia">provincia</option> -->
                                    </select>
                                    @error('parroquia')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="zona" class="">Zona</label>
                                    <select  id="zona" class="form-control" name="zona">
                                        <option selected  disabled>Choose...</option>
                                        <option value="zona">Zona</option>

                                    </select>
                                    @error('zona')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>    
                            </div>
                            <div class="form-row">
                            <div class="form-group col-6">
                                    <label for="circun" class="">Circunscripcion</label>
                                    <select id="circun" class="form-control" name="circun">
                                        <option disabled selected >Choose...</option>
                                        <!-- <option value="circun">Circun</option> -->
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
                                    <label for="junta_no" class="">Junta No.</label>
                                    <select  id="junta_no" class="form-control" name="junta_no">
                                        <option selected disabled>Choose...</option>
                                        <!-- <option value="junta_no">Junta No</option> -->
                                    </select>
                                    @error('junta_no')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                      
                    </div>
                </div>
                <div class="form_div_home mt-5">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <h3>Votes</h3>
                        <p class="total_votes_count" >Total Votes: <span id="total_voters" ></span></p>
                        <input type="hidden" class="form-control" id="total_candidates" name="total_candidates" value="">
                        <input type="hidden" class="form-control" id="total_votes" name="total_votes" value="">

                    </div>


                    <div class="form_div w-100">
                       
                            <div class="form-row mt-3">
                                <div class="form-group col-4">
                                    <label for="valid_votes">Valid</label>
                                    <input type="text" class="form-control" id="valid_votes" name="valid_votes">
                                    @error('valid_votes')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror

                                </div>
                                <div class="form-group col-4">
                                    <label for="null_votes">Null</label>
                                    <input type="text" class="form-control" id="null_votes" name="null_votes">
                                    @error('null_votes')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="blank_votes">Blank</label>
                                    <input type="text" class="form-control" id="blank_votes" name="blank_votes">
                                    @error('blank_votes')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                            <label class="Candidate_votes mt-5">Candidates Votes</label>
                            <div style="max-height: 177px;overflow-y: scroll;">
                                <table class="table table-bordered">
                                    <thead class="table_head">
                                        <tr>
                                            <th scope="col" class="col-1">Sr.</th>
                                            <th scope="col" class="col-8">Candidate name</th>
                                            <th scope="col" class="col-3">Votes</th>
                                        </tr>
                                    </thead>
                                    <tbody id="allCandidates" style="height:100px;overflow:auto;">
                                <tr style="color:red;"><th scope="col" colspan="12" style="padding-top:29px;text-align: center;">Please fill Position details First.</th></tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn text-light add_btn" data-toggle="modal" data-target="#uploadModal">
                                <i class="fa-solid fa-plus"></i>
                                Add
                            </button>
                      
                    </div>
                </div>
                <div class="form_div_home last_div_document mt-5">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <h3>Documents</h3>
                        <!-- <p class="total_votes_count">Total Votes: 00</p> -->
                    </div>


                    <div class="form_div w-100">
                       
                            <div class="form-row mt-3">
                                <div class="form-group col-12">
                                    <label for="doc_name">Document name</label>
                                    <input type="text" class="form-control" id="doc_name" name="doc_name" placeholder="Enter Document Name">
                                    @error('doc_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="form-group col-6">
                                    <label for="doc_start_time" >Beginning time</label>
                                    <input type="time" class="form-control" id="doc_start_time" name="doc_start_time">
                                    @error('doc_start_time')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror

                                </div>
                                <div class="form-group col-6">
                                    <label for="doc_end_time" >Ending Time</label>
                                    <input type="time" class="form-control" id="doc_end_time" name="doc_end_time">
                                    @error('doc_end_time')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                                <div class="form-group ml-4">
                                    <input type="checkbox" class="form-check-input" id="report_disturbance" name="report_disturbance">
                                    <label for="report_disturbance" >Report Disturbance</label>
                                    @error('report_disturbance')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror

                                </div>
                                <div class="form-group col-12">
                                    <label for="comments">Comments on disturbance</label>
                                    <input type="text" class="form-control" id="comments" name="comments" placeholder="Enter Comment">
                                    @error('comments')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                            <div class="form-row mt-3 d-flex flex-row justify-content-between">
                                <div class="form-group  Drag_drop_file w-100">
                                    <img src="images/DropImage.png">
                                    <p>Upload your document file here</p>
                                    <input type="file" class="form-control d-none" id="file" name="file">
                                    @error('file')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                                
                              
                            </div>
                      
                    </div>
                </div>
                 
            </div>


        </div>
    </div>
    <footer>
        <div class="footer d-flex justify-content-end">
                    <button class="btn footer_cancel_btn">Cancel</button>
                    <button type="submit" class="btn footer_update_btn">Upload<i class="ml-2 fa fa-arrow-right" aria-hidden="true"></i></button>
        </div>
    </footer>
</form>
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Candidate</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <div class="alert alert-danger" role="alert">
            Before Submiting Form Please select All Position Detail
        </div>
        <form id="add_candidate">
            @csrf
          <div class="form-group">
            <label for="name" class="col-form-label">Candidate name</label>
            <input type="text" id="name" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Email</label>
            <input type="email"class="form-control" id="email" name="email">
          </div>
          <input type='button' class='btn btn-info' value='Add' id='btn_add'>
        </form>
      </div>

    </div>

  </div>
</div>
    <!-- <h1>DropzoneJS File Upload Demo</h1>
<section>
  <div id="dropzone">
    <form class="dropzone needsclick" id="demo-upload" action="/upload">
      <div class="dz-message needsclick">    
        Drop files here or click to upload.<br>
        <span class="note needsclick">(This is just a demo dropzone. Selected 
        files are <strong>not</strong> actually uploaded.)</span>
      </div>
  
  </div>
</section> -->


@endsection('content')

@section('javascript')

        <script >




$(document).ready(function(){
    $(".Drag_drop_file").click(function () {
    $("#file")[0].click();
});
    $(document).on('click','.add_btn',(e)=>{
        e.preventDefault();
    });
    $(document).on('click','#btn_add',()=>{
      $.LoadingOverlay("show");
       // var data = $('form#addCandidate').serialize();
      var form = $('#add_candidate')[0];
      var formdata = new FormData(form);
      var  getSelectedOptionPosition    = $('#position').find(":selected").val();
      var  getSelectedOptionProvincia   = $('#provincia').find(":selected").val();
      var  getSelectedOptionCanton      = $('#canton').find(":selected").val();
      var  getSelectedOptionParroquia   = $('#parroquia').find(":selected").val();
      var  getSelectedOptionCircun      = $('#circun').find(":selected").val();
      var  getSelectedOptionZona        = $('#zona').find(":selected").val();
      var  getSelectedOptionJunta_no    = $('#junta_no').find(":selected").val();
      formdata.append('getSelectedOptionPosition',getSelectedOptionPosition);
      formdata.append('getSelectedOptionProvincia',getSelectedOptionProvincia);
      formdata.append('getSelectedOptionCanton',getSelectedOptionCanton);
      formdata.append('getSelectedOptionParroquia',getSelectedOptionParroquia);
      formdata.append('getSelectedOptionCircun',getSelectedOptionCircun);
      formdata.append('getSelectedOptionZona',getSelectedOptionZona);
      formdata.append('getSelectedOptionJunta_no',getSelectedOptionJunta_no);
      $.ajax({
        type: "POST",
        url: "{{ route('saveUploadDocCandidate')}}",
        processData: false,
        contentType: false,
        cache: false,
        data: formdata,
        enctype: 'multipart/form-data',
        success: function(result) {
            $.LoadingOverlay("hide");
            if (result.errors) {
            $.toaster({ priority :'danger', title :'Wrong', message :'All Field Required'});
            } else {
                var getTotal = $('#total_candidates').val();
                getTotal = Number(getTotal) + 1;
                console.log(getTotal);
                $('#total_candidates').val(getTotal);
                console.log(getTotal);
                var name = $('#name').val();
                var email = $('#email').val();
                var canidateDataAppend = `<tr>
            <td scope="row" class="row_first">`+getTotal+`</td><td>`+name+`</td>
            <td>
            <input placeholder="Enter Votes" type="text" class="form-control" name="candidate_`+getTotal+`[]"  id="candidate_`+getTotal+`"/>
            <input type="hidden" name="candidate_`+getTotal+`[]"  value="`+result.getNewCreatedCandidateId+`"/>
            <input type="hidden" name="candidate_`+getTotal+`[]"  value="`+name+`"/>

            </td>
            </tr>`;
            $('#allCandidates').append(canidateDataAppend)
            // $('.alert-danger').hide();
            $('#uploadModal').modal('hide');
            
            // Swal.fire(
            // 'Candidate Added!',
            // 'New Candidate is Added Successfully!',
            // 'success'

            // )
            Swal.fire({
              type: 'success',
              title: 'Candidate Added!',
              text: 'New Candidate is Added 🔥',
              showConfirmButton: false,
              timer: 2000
            })
            // $('#allCandidates').append(msg.candidates_name)

            // location.reload();
          }
          // $("#AddModal").modal('hide');
        },
        error: function() {
          alert("Error");
        }
      });
    });





    function fetchCandidates() {
        var position = $('#position');
        var provincia = $('#provincia');
        var parroquia = $('#parroquia');
        var canton = $('#canton');
        var circun = $('#circun');
        var junta_no = $('#junta_no');
        var zona = $('#zona');
       


            if (position.val() == null || provincia.val() == null || parroquia.val() == null || canton.val() == null || circun.val() == null || junta_no.val() == null) {
                console.log("select value")
            }else{
                // console.log(position.val())
                // console.log(provincia.val())
                // console.log(parroquia.val())
                // console.log(canton.val())
                // console.log(circun.val())
                // console.log(junta_no.val())
                // console.log(zona.val())
             

                




                $.ajax({
                type: "POST",
                url: "{{ route('getElectionCandidate')}}",
                data: {position:position.val(),parroquia:parroquia.val(),canton:canton.val(),circun:circun.val(),junta_no:junta_no.val(),zona:zona.val(),provincia:provincia.val()},
                success: function(msg) {
                    // var msg = $.parseJSON(msg);
                    console.log(msg)

                    $('#total_voters').text(msg.total_voters);
                    $('#total_votes').val(msg.total_voters);
                    $('#total_candidates').val(msg.total_candidates);                    
                    $('#allCandidates').html(msg.candidates_name)
                   
                }
            });
        }



            
        }
        window.onload = fetchCandidates;



    $('#change').click(function(e) {  
        var position = $('#position');
        var provincia = $('#provincia');
        var parroquia = $('#parroquia');
        var canton = $('#canton');
        var circun = $('#circun');
        var junta_no = $('#junta_no');
        var zona = $('#zona');
       


            if (position.val() == null || provincia.val() == null || parroquia.val() == null || canton.val() == null || circun.val() == null || junta_no.val() == null) {
                console.log("select value")
            }else{
                // console.log(position.val())
                // console.log(provincia.val())
                // console.log(parroquia.val())
                // console.log(canton.val())
                // console.log(circun.val())
                // console.log(junta_no.val())
                // console.log(zona.val())
             

                




                $.ajax({
                type: "POST",
                url: "{{ route('getElectionCandidate')}}",
                data: {position:position.val(),parroquia:parroquia.val(),canton:canton.val(),circun:circun.val(),junta_no:junta_no.val(),zona:zona.val(),provincia:provincia.val()},
                success: function(msg) {
                    // var msg = $.parseJSON(msg);
                    console.log(msg)

                    $('#total_voters').text(msg.total_voters);
                    $('#total_votes').val(msg.total_voters);
                    $('#total_candidates').val(msg.total_candidates);
                    $('#allCandidates').html(msg.candidates_name)
                   
                }
            });



            }
});
// position detail code start here





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
          html = "";
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
            html = "";
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
           var html = "";
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
           var femaleVoter = (result.data[0].female_voters) ?result.data[0].female_voters : null;
           var MaleVoter = result.data[0].male_voters;
           var html = "";
           for (let i = 1; i <= femaleVoter; i++) {
                html += '<option  value="'+ i+'F'+'">' + i+'F' +'</option>';
            }
            $('select[name=junta_no]').append(html);

          var Malehtml = "";
           for (let i = 1; i <= MaleVoter; i++) {
              Malehtml += '<option  value="'+ i+'M'+'">' + i+'M' +'</option>';
            }
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