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
                                        <option value="position">position</option>
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
                                        <option value="provincia">provincia</option>
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
                                        <option value="parroquia">provincia</option>
                                    </select>
                                    @error('parroquia')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="circun" class="">Circunscripcion</label>
                                    <select id="circun" class="form-control" name="circun">
                                        <option disabled selected >Choose...</option>
                                        <option value="circun">Circun</option>
                                    </select>
                                    @error('circun')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                            <div class="form-row">
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
                                <div class="form-group col-6">
                                    <label for="junta_no" class="">Junta No.</label>
                                    <select  id="junta_no" class="form-control" name="junta_no">
                                        <option selected disabled>Choose...</option>
                                        <option value="junta_no">Junta No</option>
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
                            <table class="table table-bordered">
                                <thead class="table_head">
                                    <tr>
                                        <th scope="col" class="col-1">Sr.</th>
                                        <th scope="col" class="col-8">Candidate name</th>
                                        <th scope="col" class="col-3">Votes</th>
                                    </tr>
                                </thead>
                                <tbody id="allCandidates" style="height:100px;overflow:auto;">
                               
                                </tbody>
                            </table>
                            <button class="btn text-light add_btn">
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
                                <div class="form-group  Drag_drop_file">
                                    <img src="images/DropImage.png">
                                    <p>Drag / Drop your document file here</p>
                                    <input type="file" class="form-control d-none" id="Drag_drop_field" name="Drag_drop_file">

                                </div>
                                <div class="form-group  Scan_file">
                                    <img src="images/Camera.png">
                                    <p>Scan through camera</p>
                                    <input type="file" class="form-control d-none" id="Scan_field" name="Scan_field">

                                </div>
                                
                                <div class="input-group hdtuto control-group lst increment" >
      <input type="file" name="filenames[]" class="myfrm form-control">
      <div class="input-group-btn"> 
        <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
      </div>
    </div>
    <div class="clone hide">
      <div class="hdtuto control-group lst input-group" style="margin-top:10px">
        <input type="file" name="filenames[]" class="myfrm form-control">
        <div class="input-group-btn"> 
          <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
        </div>
      </div>
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

// $(document).ready(function() {
// // $("#uploadDocument").validate();


// $("#uploadDocument").validate({
//     rules: {
//       position : {
//         required: true,
//       },
//       circun: {
//         required: true,
//       },
//     },
//     messages : {
//       position: {
//         required: "Select Position"
//       },
//       circun: {
//         required: "Select Circun",
//       },
     
//     }
//   });

// });


$(document).ready(function(){
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
                    $('#total_votes').text(msg.total_voters);
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
                    $('#total_votes').text(msg.total_voters);
                    $('#total_candidates').val(msg.total_candidates);
                    $('#allCandidates').html(msg.candidates_name)
                   
                }
            });



            }
});
});  
        </script>



<!-- <script>
    $(function(){
    $('.selection').click(function(){
    var count = 0;


    $('select').each(function(){
      
    if($(this).val() != null){
       count ++; 
     }
     
  })
    if(count == 4) {
      console.log('all selected');
    }
  })
  
})
</script> -->
@endsection('javascript')
