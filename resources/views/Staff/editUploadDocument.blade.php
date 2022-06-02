@extends('layouts.main')

@section('content')
<style>
    div.show-image {
    position: relative;
    float:left;
    margin:5px;
}
div.show-image:hover img{
    opacity:0.5;
}
div.show-image:hover a {
    display: block;
}
div.show-image a {
    position:absolute;
    display:none;
}
div.show-image a.update {
    top: 9px;
    left: 19px;
}
div.show-image a.delete {
    top: 9px;
    left: 64%;
}
</style>

<div class="main_content">
            
            <div class="container-fluid creat_election_div" style="margin-top: 40px;">

            <form id="addForm" action="{{route('updateDocument')}}" method="POST" enctype="multipart/form-data">
                           @csrf
                           <input type="hidden" id="id" name="id" value="{{$doc->id}}">
                <div class="heading_create_new_election my-4">
                    <h2>Edit Document</h2>
                </div>
                <div class="form_div_home">
                    <h3>Position details</h3>

                    <div class="form_div w-100 selection">
                      
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="position" class="">Position</label>
                                    <select id="position" class="form-control" name="position">
                                        <option selected>Choose...</option>
                                        <option {{$doc->position == 'position'? 'selected':''}} value="position">position</option>
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
                                        <option selected>Choose...</option>
                                        <option  {{$doc->provincia =='provincia' ? 'selected': ''}} value="provincia">provincia</option>
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
                                        <option selected>Choose...</option>
                                        <option {{$doc->canton == 'canton' ? 'selected' : ''}} value="provincia">provincia</option>
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
                                        <option selected>Choose...</option>
                                        <option {{$doc->parroquia == 'parroquia' ? 'selected' : ''}}  value="parroquia">provincia</option>
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
                                        <option selected>Choose...</option>
                                        <option {{$doc->canton == 'canton' ? 'selected' : ''}}  value="circun">Circun</option>
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
                                    <select id="zona" class="form-control" name="zona">
                                        <option selected>Choose...</option>
                                        <option {{$doc->zona == 'zona' ? 'selected' : ''}}  value="zona">Zona</option>

                                    </select>
                                    @error('zona')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="junta_no" class="">Junta No.</label>
                                    <select id="junta_no" class="form-control" name="junta_no">
                                        <option selected>Choose...</option>
                                        <option {{$doc->junta_no == 'junta_no' ? 'selected' : ''}} value="junta_no">Junta No</option>
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
                        <p class="total_votes_count">Total Votes: {{$doc->valid_votes + $doc->null_votes + $doc->blank_votes}}</p>
                    </div>


                    <div class="form_div w-100">
                       
                            <div class="form-row mt-3">
                                <div class="form-group col-4">
                                    <label for="valid_votes">Valid</label>
                                    <input type="text" class="form-control" id="valid_votes" name="valid_votes" value="{{$doc->valid_votes}}">
                                    @error('valid_votes')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror

                                </div>
                                <div class="form-group col-4">
                                    <label for="null_votes">Null</label>
                                    <input type="text" class="form-control" id="null_votes" name="null_votes" value="{{$doc->null_votes}}">
                                    @error('null_votes')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="blank_votes">Blank</label>
                                    <input type="text" class="form-control" id="blank_votes" name="blank_votes" value="{{$doc->blank_votes}}">
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
                                <tbody class="allCandidates" style="height:100px;overflow:auto;">
                                 @php
                                     $i=1;
                                 @endphp
                                    @foreach ( $getCandidateNameAndVOte as $getCandidateNameAndVOtes )
                                        <tr>
                                            <td scope="row" class="row_first">{{$i}}</td><td>{{$getCandidateNameAndVOtes->candidate_name}}</td>
                                            <td>
                                            <input placeholder="Enter Votes" type="text" class="form-control" name="candidate_data[{{$i}}][]"  id="candidate_data{{$getCandidateNameAndVOtes->candidate_id}}" value="{{$getCandidateNameAndVOtes->candidate_votes}}"/>
                                            <input type="hidden" name="candidate_data[{{$i}}][]"  value="{{$getCandidateNameAndVOtes->candidate_id}}"/>
                                            <input type="hidden" name="candidate_data[{{$i}}][]"  value="{{$getCandidateNameAndVOtes->candidate_name}}"/>

                                            </td>
                                        </tr>
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach
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
                                    <input type="text" class="form-control" id="doc_name" name="doc_name" placeholder="Enter Document Name" value="{{$doc->doc_name}}">
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
                                    <input type="time" class="form-control" id="doc_start_time" name="doc_start_time" value="{{$doc->doc_start_time}}">
                                    @error('doc_start_time')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror

                                </div>
                                <div class="form-group col-6">
                                    <label for="doc_end_time" >Ending Time</label>
                                    <input type="time" class="form-control" id="doc_end_time" name="doc_end_time" value="{{$doc->doc_end_time}}">
                                    @error('doc_end_time')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                                <div class="form-group ml-4">
                                    <input type="checkbox" class="form-check-input" id="report_disturbance" name="report_disturbance" {{$doc->report_disturbance == 'on' ? 'checked' :''}}>
                                    <label for="report_disturbance" >Report Disturbance</label>
                                    @error('report_disturbance')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror

                                </div>
                                <div class="form-group col-12">
                                    <label for="comments">Comments on disturbance</label>
                                    <input type="text" class="form-control" id="comments" name="comments"  value="{{$doc->comments}}"placeholder="Enter Comment">
                                    @error('comments')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                            <div class="form-row mt-3 d-flex flex-row justify-content-between">
                                <div class="form-group  Drag_drop_file">
                                    <img src="{{ asset('images/DropImage.png') }}">
                                    <p>Drag / Drop your document file here</p>
                                    <input type="file" class="form-control d-none" id="file" name="file">

                                </div>
                                <div class="form-group  Scan_file">
                                    <img src="{{asset('images/Camera.png')}}">
                                    <p>Scan through camera / upload Images</p>
                                    
                                </div>
                                <div class="ml-3">
                                    <a type="button" class="btn btn-primary" value="View File" @if (!empty($doc->file))
                                        href="{{asset('doc_images/'.$doc->file.'')}}"
                                    @else
                                    href=""
                                    @endif target="_blank" />View File</a>
                                </div>
                                <div class="ml-3">
                                    <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#imagemodal">View Images</a>
                                </div>
                            </div>
                            <!-- <form action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }} -->
                                <input type="file" class="latest_input d-none form-control my-2" id="document_upload_Images" name="document_upload_Images[]" multiple/>

                                <!-- <input type="submit" class="btn btn-success" name='submitImage' value="Upload Image"/> -->
                            <!-- </form> -->
                            <br/>
                            <div id="latest_image_preview"></div>
                      <input type="hidden" id="total_candidate" value="{{$total_candidates}}">
                    </div>
                </div>
                <footer>
                    <div class="footer d-flex justify-content-end">
                        <button class="btn footer_cancel_btn">Cancel</button>
                        <button type="submit" class="btn footer_update_btn">Upload<i class="ml-2 fa fa-arrow-right" aria-hidden="true"></i></button>
                    </div>
                </footer>
            </form>
            </div>


        </div>
    </div>
    <div class="modal fade imagemodalData" id="imagemodal" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="justify-content: center; overflow-x:scroll">
            @foreach ($files as $file)
            <div class="show-image" data-id='{{$file->id}}'>
            <img class="doc_images" id="old_image" style="width:75px;height:92px;margin: 0px 11px;" data-id="{{$file->id}}" src="{{ asset("doc_images/$file->file_name")}}" alt="First slide">
                <a class="update image_view" data-id="{{$file->id}}"  onclick="window.open('{{ asset("doc_images/$file->file_name")}}', '_blank');"><i class="fa fal fa-eye"></i></a>
                <a class="delete delete_btn" data-doc="{{$file->document_id}}"  data-Image="{{$file->file_name}}" data-id='{{$file->id}}' ><i class="fa far fa-trash-alt"></i></a>
            </div>
            @endforeach  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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

@endsection('content')

@section('javascript')
<script src="{{asset('js/dropzone.js')}}"></script>
<script >
            $(document).ready(()=>{
                $('.Scan_file').click(function(e){
                    e.stopPropagation;
                    $('.latest_input[type=file]').click();
                });
                $("#document_upload_Images").change(function(){        
                    $('#latest_image_preview').html("");        
                    var total_file=document.getElementById("document_upload_Images").files.length;    
                    if(total_file >= 8)
                    {
                        $('#latest_image_preview').addClass('Scrollable_div');
                    }    
                    for(var i=0;i<total_file;i++)        
                    {   
                        $('#latest_image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");        
                    }
                    
                });
                $(document).on('click', '.delete_btn', function() {
                $.LoadingOverlay("show");
                var getImageId = $(this).attr('data-id');
                var getDocId = $(this).attr('data-doc');
                var getImagePath = $(this).attr('data-Image');
                $.ajax({
                    type: "POST",
                    url: "{{ route('DeleteDocImage')}}",
                    data: {
                    'getImageId': getImageId,
                    'getDocId': getDocId,
                    'getImagePath': getImagePath,
                    },
                    success: function(result) {
                    $.LoadingOverlay("hide");
                    Swal.fire({
                        type: 'success',
                        title: 'Delete!',
                        text: 'Document Image Delete successfully',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $('.show-image[data-id='+getImageId+']').remove();
                    },
                    error: function() {
                    alert("Error");
                    }
                });
                });
                // $('.image_view').click(function (){
                //     var image = new Image();
                    
                //     var id = $(this).attr('data-id');
                //     console.log(id);
                //     image.src = $("#old_image[data-id="+id+"]").attr('src');

                //     var w = window.open("",'_blank');
                //     w.document.write(image.outerHTML);
                //     w.document.close(); 
                // });
                $(document).on('click','.add_btn',(event)=>{
                    event.preventDefault();
                //     var form = $('form#addForm')[0]
                //     var data = new FormData(form);
                //     console.log(data);
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
                    var  getdocId    = $('#id').val();
                    formdata.append('getSelectedOptionPosition',getSelectedOptionPosition);
                    formdata.append('getSelectedOptionProvincia',getSelectedOptionProvincia);
                    formdata.append('getSelectedOptionCanton',getSelectedOptionCanton);
                    formdata.append('getSelectedOptionParroquia',getSelectedOptionParroquia);
                    formdata.append('getSelectedOptionCircun',getSelectedOptionCircun);
                    formdata.append('getSelectedOptionZona',getSelectedOptionZona);
                    formdata.append('getSelectedOptionJunta_no',getSelectedOptionJunta_no);
                    formdata.append('getdocId',getdocId);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('saveUploadEditDocCandidate')}}",
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
                                var getTotal = $('#total_candidate').val();
                                getTotal = Number(getTotal) + 1;
                                console.log(getTotal);
                                $('#total_candidate').val(getTotal);
                                var name = $('#name').val();
                                var email = $('#email').val();
                                var canidateDataAppend = `<tr>
                                            <td scope="row" class="row_first">`+getTotal+`</td><td>`+name+`</td>
                                            <td>
                                            <input placeholder="Enter Votes" type="text" class="form-control" name="candidate_data[`+getTotal+`][]"  id="candidate_data`+result.getNewCreatedCandidateId+`" value=""/>
                                            <input type="hidden" name="candidate_data[`+getTotal+`][]"  value="`+result.getNewCreatedCandidateId+`"/>
                                            <input type="hidden" name="candidate_data[`+getTotal+`][]"  value="`+name+`"/>

                                            </td>
                                        </tr>`;
                            $('.allCandidates').append(canidateDataAppend)
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
                $(".Drag_drop_file").click(function () {
                    $("#file")[0].click();
                });

                $(".btn-success").click(function(){ 
                    var lsthmtl = $(".clone").html();
                    $(".increment").after(lsthmtl);
                });
                $("body").on("click",".btn-danger",function(){ 
                    $(this).parents(".hdtuto").remove();
                });


            $('.Drag_drop_file').click(()=>{
                // alert(2323);
                $('.Drag_drop_file > input#Drag_drop_field').click();
            });
                $(function(){
                $('.selection').click(function(){
                var count = 0;
                // alert(here)

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
        });

</script>
@endsection('javascript')
