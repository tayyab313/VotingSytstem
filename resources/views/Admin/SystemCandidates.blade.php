@extends('layouts.main')

@section('content')

<!-- Main Content Here -->
<div class="main_content mt-2">
  <div class="container-fluid">
    <h2 class="heading_candidate">Candidates</h2>
  </div>
  <div class="document_heading container-fluid">
    <!-- <form > -->
    <div class="form-row mt-3">
      <!-- <div class="form-group col-sm-12 col-md-4 col-lg-4 has-search">
        <span class="fa fa-search form-control-feedback"></span>
        <input type="text" class="form-control" id="search" name="search" placeholder="Search Candidate">

      </div> -->
      <div class="btn_parent_div form-group col-sm-12  col-md-12 col-lg-12 d-flex justify-content-end ">
        <div class="row">
        
          <button class="btn filter_btn Candidate_btns multi_btn " id="bulk_delete"><i class="fas fa fa-trash-alt"></i> Bulk Delete
          </button>
          <!-- <button class="btn filter_btn Candidate_btns multi_btn"><i class="fa fa-camera mr-1" aria-hidden="true"></i>Upload Picture
          </button> -->
          <button data-toggle="modal" data-target="#uploadModal" class="btn filter_btn Candidate_btns multi_btn"><i class="fa fa-download mr-1" aria-hidden="true"></i> Import
          </button>
          <a href="{{ route('exportCandidate') }}" class="btn filter_btn Candidate_btns multi_btn"><i class="fa fa-upload mr-1" aria-hidden="true"></i>Export
          </a>
          <button class="btn filter_btn Candidate_btns multi_btn" data-toggle="modal" data-target="#FIlterModal"><i class="fa fa-filter mr-1" aria-hidden="true"></i>New Search
          </button>
          <button class="btn filter_btn Candidate_btns comon_color_btn AddCandidate" data-toggle="modal" data-target="#AddModal"><i class="fa-solid fa-plus mr-1"></i>New Candidate
          </button>
        </div>
      </div>
    </div>
    <!-- </form> -->

  </div>
  <div class="table_div container-fluid">

    <table class="table" id="table_datatable">
      <thead class="table_head">
        <tr>
          <th style="display: flex;justify-content: center;"><input type="checkbox" name="Main_checkbox_bulk" class="Main_checkbox_bulk" "></th>
          <th ></th>
          <th scope="col">Name</th>
          <th scope="col">Political Party</th>
          <th scope="col">Phone</th>
          <th scope="col">Email ID</th>
          <th scope="col">Position</th>
          <th scope="col">Provincia</th>
          <th scope="col">Canton</th>
          <th scope="col">Parroquia</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="data_table_tbody">
        @foreach($systemCandidates as $candi)
        <tr>
          <th scope="row" style="text-align: center;"><input type="checkbox" name="bulk_delete[]" class="checkbox_bulk" value="{{$candi->id}}"></th>
          <th scope="row" style="text-align: center;"><img @if(!empty($candi->candidate_img)) src="{{ asset("avatars/$candi->candidate_img")}}" @endif 
          @if (empty($candi->candidate_img))
          src="{{ asset('images/tianiaPress.png')}}"
          @endif
          class="table_candidate_img"></th>

          <th scope="row">{{$candi->name}}</th>
          <td>{{$candi->pol_party}}</td>
          <td>{{$candi->phone}}</td>
          <td>{{$candi->email}}</td>
          <th scope="row">{{$candi->position}}</th>
          <td>{{$candi->state}}</td>
          <td>{{$candi->city}}</td>
          <td>{{$candi->parroquia}}</td>
          <td class="d-flex">
            <a href="#" class="mr-1 text-dark edit_delete_btn " data-id="{{$candi->id}}" data-toggle="modal" data-target="#EditModal"><i class="fa fal fa-edit"></i></a>
            <a href="#" class=" ml-1 text-dark edit_delete_btn" data-toggle="modal" data-id="{{$candi->id}}" data-target="#DeleteModal"><i class="fa far fa-trash-alt"></i></a>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>


  </div>
</div>

</div>
<!-- modals -->
<!-- delete modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalTitle" aria-hidden="true">
  <div class="delete_modal modal-dialog modal-dialog-centered m-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <form id="deleteCandidate">
        <div class="modal-body d-flex justify-content-center align-items-center flex-column">
          <img src="images/delete_pic.png" class="delete_image">
          <p class="delete_text">Are you sure you want to delete?</p>
          <input type="hidden" name="delete_id" id="delete_id" value="">
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-secondary no_btn" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary comon_color_btn yes_btn">Yes</button>
      </form>
    </div>
  </div>
</div>
</div>
<!-- end here -->

<!-- add modal -->

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog modal-dialog-centered m-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new Candidate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" style="display:none"></div>
        <div class="form_div w-100">
          <form id="addCandidates">
            @csrf
            <div class="form-row mt-3 d-flex flex-row ">
              <div id="candi_img" class="form-group  candidate_photo">
                <img src="images/can_camera.png" class="can_cam_image">
                <img id="preview_candi_img" style="width: 78px;height: 83px;border-radius: 8px;position: relative;top: 8px;right: 0px;">

                <p class="candidate_p_style">Candidate Photo</p>
                <input type="file" class="form-control d-none" id="drag_drop_field" name="drag_drop_file" oninput="preview_candi_img.src=window.URL.createObjectURL(this.files[0])">

              </div>
              <div id="pol_img" class="form-group  political_party_logo">
                <img src="images/can_camera.png" class="can_cam_image">
                <img id="preview_pol_party" style="width: 78px;height: 83px;border-radius: 8px;position: relative;top: 8px;right: 0px;">
                <p class="candidate_p_style">Political party logo</p>
                <input type="file" class="form-control d-none" id="pol_party_logo" name="pol_party_logo" oninput="preview_pol_party.src=window.URL.createObjectURL(this.files[0])">

              </div>

            </div>
            <div class="form-row mt-3">
              <div class="form-group col-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter">
              </div>
              <div class="form-group col-6">
                <label for="Political_Party" class="">Political Party</label>
                <select id="Political_Party" name="pol_party" class="form-control">
                  <option disabled selected>Choose...</option>
                  <option value="pol_party">Circun</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" maxlength="12" placeholder="Enter">
              </div>
              <div class="form-group col-6">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <label for="position" class="">Position</label>
                <select id="position" name="position" class="form-control">
                  <option disabled selected>Choose...</option>
                  @foreach ($positons as $positionVal)
                  <option value="{{$positionVal['position_val']}}">{{$positionVal['position_val']}}</option>
                    
                  @endforeach
                </select>
              </div>
              <div class="form-group col-6">
                <label for="state" class="">Provincia</label>
                <select id="state" name="state" class="form-control">
                  <option disabled selected>Choose...</option>
                  @foreach ($getSTatVal as $getSTatVals)
                  <option value="{{$getSTatVals['state_name']}}">{{$getSTatVals['state_name']}}</option>
                    
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <label for="city" class="">Canton</label>
                <select id="city" name="city" class="form-control">
                  <option disabled selected>Choose...</option>
                  <option>...</option>
                  <option value="city">City</option>
                </select>
              </div>
              <div class="form-group col-6">
                <label for="parroquia" class="">Parroquia</label>
                <select id="parroquia" name="parroquia" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                  <option value="parroquia">Parroquias</option>
                </select>
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Close</button>
        <button id="submit" type="button" class="btn btn-primary save_btn CanAddBtn">Add</button>
      </div>
      </form>

    </div>
  </div>
</div>


<!-- EDIT MODAL -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog modal-dialog-centered m-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Candidate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger alert-danger-edit" style="display:none"></div>

        <div class="form_div w-100">
          <form id="updateCandidate" name="updateCandidate">
            <div class="form-row mt-3 d-flex flex-row ">
              <div class="form-group  candidate_photo" id="update_edit_candidate_profile">
                <img src="images/can_camera.png" class="can_cam_image">
                <img id="edit_preview_candi_img" style="width: 78px;height: 83px;border-radius: 8px;position: relative;top: 8px;right: 0px;">
                <p class="candidate_p_style">Candidate Photo</p>
                <input type="file" class="form-control d-none drag_drop_file" id="edit_drag_drop_field" name="edit_drag_drop_field" oninput="edit_preview_candi_img.src=window.URL.createObjectURL(this.files[0])">

              </div>
              <div class="form-group  political_party_logo" id="update_edit_pol_profile">
                <img src="images/can_camera.png" class="can_cam_image">
                <img id="edit_preview_pol_img" style="width: 78px;height: 83px;border-radius: 8px;position: relative;top: 8px;right: 0px;">
                <p class="candidate_p_style">Political party logo</p>
                <input type="file" class="form-control d-none drag_drop_file" id="edit_pol_party" name="edit_pol_party" oninput="edit_preview_pol_img.src=window.URL.createObjectURL(this.files[0])">

              </div>

            </div>
            <div class="form-row">
              <div class="form-group col-6 mt-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="edit_name" name="name" placeholder="Enter">
              </div>
              <div class="form-group col-6 mt-3">
                <label for="political_party" class="">Political Party</label>
                <select id="edit_political_party" name="pol_party" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                  <option value="pol_party">Circun</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="edit_phone" name="phone" maxlength="12" placeholder="Enter">
              </div>
              <div class="form-group col-6">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="edit_email" name="email" placeholder="Enter" disabled>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <label for="edit_position" class="">Position</label>
                <select id="edit_position" name="edit_position" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                  <option value="position">position</option>

                </select>
              </div>
              <div class="form-group col-6">
                <label for="edit_state" class="">Provincia</label>
                <select id="edit_state" name="edit_state" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                  <option value="state">position</option>

                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <label for="edit_city" class="">Canton</label>
                <select id="edit_city" name="edit_city" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                  <option value="city">position</option>

                </select>
              </div>
              <div class="form-group col-6">
                <label for="edit_parroquia" class="">Parroquia</label>
                <select id="edit_parroquia" name="edit_parroquia" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                  <option value="parroquia">position</option>

                </select>
              </div>
            </div>
            <input type="hidden" id="update_id" name="update_id" value="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary save_btn updateCandidateBtn" style="width: 76px;">Update</button>
        </form>

      </div>
    </div>
  </div>

</div>

<!-- end here  -->
<!-- side modal -->

<div class="modal fade amk right from-right delay-200" id="FIlterModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalTitle" aria-hidden="true">
  <div class="modal-dialog  modal-dialog modal-dialog-centered m-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Search</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form_div w-100">
          <form id="filterForm">
          <div class="form-row">
              <div class="form-group col-12">
                <label for="Position" class="">Position</label>
                <select id="Position" name="Position" class="form-control">
                  <option disabled selected>Choose...</option>
                  @foreach ($positons as $positon)
                        <option value="{{$positon->position_val}}">{{$positon->position_val}}</option>
                        
                      @endforeach
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <label for="provincia" class="">Provincia</label>
                <select id="provincia" name="provincia" class="form-control">
                  <option value="null" selected>Choose...</option>
                  @foreach ($getSTatVal as $getSTatVals)
                  <option value="{{$getSTatVals['state_name']}}">{{$getSTatVals['state_name']}}</option>
                    
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <label for="canton" class="">Canton</label>
                <select id="canton" name="canton" class="form-control">
                  <option value="null" selected>Choose...</option>
                 
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <label for="parroquia" class="">Parroquia</label>
                <select id="parroquia" name="parroquia" class="form-control">
                  <option value="null" selected>Choose...</option>
                 
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer d-block">
        <button type="button" class="btn btn-primary update_filter_btn w-50">Search</button>
        <button class="btn filter_btn " onClick="window.location.reload();"><i class="fas fa fa-sync"></i> Reset
        </button>
      </div>
    </div>
  </div>
</div>

<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Upload Candidate</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="alert alert-danger mx-auto" style="width: 97%;">Duplicate Emails will be  Ignored by the System Automatically</div>
      <div class="modal-body">
        @if(isset($errors) && $errors->any())
        <div class="alert alert-danger" >
           @foreach ($errors->all() as $error)
             {{$error}}
           @endforeach
        </div>
        @endif
        <!-- Form -->
        <form method='post' action='{{ route('importCandidate') }}' enctype="multipart/form-data">
          Select file : <input type='file' name='file' id='file' class='form-control'><br>
          <input type='button' class='btn btn-info' value='Upload' id='btn_upload'>
        </form>
      </div>

    </div>

  </div>
</div>




@endsection('content')

@section('javascript')
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(() => {
   

    $('#table_datatable').DataTable({
      language: {
        searchPlaceholder: "Search Tables",
        search: ''
      }
    });

    // $("#addCandidate").submit(function(event) {
    //   submitForm();
    //   return false;
    // });

    // function submitForm() {

    //   // var data = $('form#addCandidate').serialize();
    //   var form = $('#addCandidate')[0];
    //   var formdata = new FormData(form);
    //   console.log(data);
    //   $.ajax({
    //     type: "POST",
    //     url: "{{ route('saveCandidate')}}",
    //     cache: false,
    //     data: formdata,
    //     enctype: 'multipart/form-data',
    //     success: function(result) {
    //       // $("#contact").html(response)
    //       if (result.errors) {
    //         $('.alert-danger').html('');

    //         $.each(result.errors, function(key, value) {
    //           $('.alert-danger').show();
    //           $('.alert-danger').append('<li>' + value + '</li>');
    //         });
    //       } else {
    //         $('.alert-danger').hide();
    //         $('#addCandidate').modal('hide');
    //         // Swal.fire(
    //         // 'Candidate Added!',
    //         // 'New Candidate is Added Successfully!',
    //         // 'success'

    //         // )
    //         Swal.fire({
    //           type: 'success',
    //           title: 'Candidate Added!',
    //           text: 'New Candidate is Added 🔥',
    //           showConfirmButton: false,
    //           timer: 2000
    //         })
    //         location.reload();
    //       }
    //       // $("#AddModal").modal('hide');
    //     },
    //     error: function() {
    //       alert("Error");
    //     }
    //   });
    // }
    $('.CanAddBtn').click(()=>{
      $.LoadingOverlay("show");
       // var data = $('form#addCandidate').serialize();
      var form = $('#addCandidates')[0];
      var formdata = new FormData(form);
      console.log(formdata);
      $.ajax({
        type: "POST",
        url: "{{ route('saveCandidate')}}",
        processData: false,
        contentType: false,
        cache: false,
        data: formdata,
        enctype: 'multipart/form-data',
        success: function(result) {
          $.LoadingOverlay("hide");
          // $("#contact").html(response)
          if (result.errors) {
                    $.toaster({
                      priority: 'danger',
                      title: 'Wrong',
                      message: 'All Fields Required'
                    });
                  } else {
            $('.alert-danger').hide();
            $('#addCandidate').modal('hide');
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
            location.reload();
          }
          // $("#AddModal").modal('hide');
        },
        error: function() {
          alert("Error");
        }
      });
    });
    $("#close").click(function() {
      $('#exampleModal').modal('hide')
    });

    $('#EditModal').on('show.bs.modal', function(event) {

      var button = $(event.relatedTarget) // Button that triggered the modal
      //   var admin_id = button.data('admin')
      var id = button.data('id')
      $.ajax({
        type: "POST",
        url: "{{ route('getCandidate')}}",
        cache: false,
        data: {
          id: id
        },
        success: function(result) {
          console.log(result);
          $('#edit_political_party').val(result.data.pol_party);
          $('#edit_email').val(result.data.email);
          $('#edit_phone').val(result.data.phone);
          // $('#edit_posi?tion').val(result.data.position);
          $('#edit_city').html('<option selected value="'+result.data.city+'">'+result.data.city+'</option>');
          // $('#edit_city').attr('disabled','disabled');
          // $('#edit_parroquia').attr('disabled','disabled');
          $('#edit_parroquia').html('<option selected value="'+result.data.parroquia+'">'+result.data.parroquia+'</option>');
          $('#edit_name').val(result.data.name);
          var UserData = result.positons;
          var selecteddata ='';
          var GetStateVal = result.getSTatVal;
          var getStateData = '<option disabled >Choose...</option>';

          let userFullState = GetStateVal.map(function(element){
            if(element.state_name === result.data.state)
            {
              selecteddata='selected';
            }
            getStateData+=`<option value='`+element.state_name+`' `+selecteddata+`>`+element.state_name+`</option>`;
            selecteddata='';
          });
          $('#edit_state').html(getStateData);
          // $('#edit_position').html(getTabelData);
          var selected = '';
          var getTabelData='<option disabled >Choose...</option>';
          let userFullnames = UserData.map(function(element){
            if(element.position_val === result.data.position)
            {
              selected='selected';
            }
            getTabelData+=`<option value='`+element.position_val+`' `+selected+`>`+element.position_val+`</option>`;
            selected='';
          })
          $('#edit_position').html(getTabelData);

          if(result.data.candidate_img != null)
          {
            var getCanPic = `{{asset('avatars/`+result.data.candidate_img+`')}}`;
            // console.log(getCanPic,result.data.candidate_img);
            $('#edit_preview_candi_img').removeClass('d-none');
            $('#edit_preview_candi_img').attr('src',`{{asset('avatars/`+result.data.candidate_img+`')}}`);

          }
          if(result.data.candidate_img == null)
          {
            // $('#edit_preview_candi_img').addClass('d-none');
            $('#edit_preview_candi_img').removeAttr('src',"");
            $('#edit_preview_candi_img').attr('src',"{{asset('images/tianiaPress.png')}}");

          }

          if(result.data.img_pol_party != null)
          {
            $('#edit_preview_pol_img').removeClass('d-none');
            $('#edit_preview_pol_img').attr('src',`{{asset('avatars/`+result.data.img_pol_party+`')}}`);
          }
          if(result.data.img_pol_party == null)
          {
            // $('#edit_preview_pol_img').addClass('d-none');
            $('#edit_preview_pol_img').removeAttr('src',"");
            $('#edit_preview_pol_img').attr('src',"{{asset('images/tianiaPress.png')}}");
          }

        },
        error: function() {
          alert("Error");
        }
      });

      //   var status = button.data('status')
      //   var reason = button.data('reason')

      //   $("#status").val(status)
      //   $("#reason").val(reason)
      //   $("#id").val(id)
      //   $("#admin_id").val(admin_id)




      // alert(admin_id) 
      // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      // var modal = $(this)
      // console.log(modal);
      // modal.find('.modal-title').text('New message to ' + recipient)
      // modal.find('.modal-body input').val(recipient)
    })

    // $("#updateCandidate").submit(function(event) {
    //   updateForm();
    //   return false;
    // });
      $(document).on('click','.edit_delete_btn',function(e){
        e.preventDefault();
        var getId = $(this).attr('data-id');
        $('#update_id').val(getId);
      });
      $('.Main_checkbox_bulk').click(function(e){
        if($('.Main_checkbox_bulk:checked'))
        {
          $('.checkbox_bulk').prop( "checked", true );
        }
        if($('.Main_checkbox_bulk').prop('checked')==false)
        {
          $('.checkbox_bulk').prop( "checked", false );

        }
      });
      $(document).on('click','#bulk_delete',function(e){
        var id =[];
        if(confirm('Are you sure to delete this data ?'))
        {
          $('.checkbox_bulk:checked').each(function(e){
            id.push($(this).val());
          });
          if(id.length > 0)
          {
          $.LoadingOverlay("show");
            $.ajax({
              url:"{{route('bulkDelete')}}",
              method:'get',
              data:{id:id},
              success:function(data)
              {
                $.LoadingOverlay("hide");
                Swal.fire({
                  type: 'success',
                  title: 'Deleted!',
                  text: 'Candidates Deleted Successfully✨',
                  showConfirmButton: false,
                  timer: 2000
                })
                location.reload();
              } 
            });
          }
          else{
            alert('Please select atleast one checkbox');
          }
        }
      });
    $(document).on('click','.updateCandidateBtn',function(e){
      e.preventDefault();
      var form = $('#updateCandidate')[0];
      var formdata = new FormData(form);
      $.LoadingOverlay("show");
      console.log(formdata);
      $.ajax({
        type: "POST",
        url: "{{ route('updateCandidate')}}",
        processData: false,
        contentType: false,
        cache: false,
        data: formdata,
        enctype: 'multipart/form-data',
        success: function(result) {
          $.LoadingOverlay("hide");
          // $("#contact").html(response)
          if (result.errors) {
            $('.alert-danger-edit').html('');

            $.each(result.errors, function(key, value) {
              $('.alert-danger-edit').show();
              $('.alert-danger-edit').append('<li>' + value + '</li>');
            });
          } else {
            $('.alert-danger-edit').hide();
            // $('#EditModal').modal('hide');
            // Swal.fire(
            // 'Candidate Updated!',
            // 'Candidate is Updated Successfully!',
            // 'success'
            // )
            Swal.fire({
              type: 'success',
              title: 'Candidate Updated!',
              text: 'Candidate is Updated Successfully ✨',
              showConfirmButton: false,
              timer: 2000
            })
            location.reload();
          }
        },
        error: function() {
          alert("Error");
        }
      });
    });


    $('#btn_upload').click(function() {
      $.LoadingOverlay("show");

      var fd = new FormData();
      var files = $('#file')[0].files[0];
      fd.append('file', files);

      // AJAX request
      $.ajax({
        url: "{{ route('importCandidate')}}",
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
          console.log(response);
          $.LoadingOverlay("hide");

          if (response.errors) {
              $.toaster({ priority :'danger', title :'Wrong', message :'Invalid File Format'});
            } else {
                // $('#uploadModal').modal('hide');
                Swal.fire(
                'File Uploaded!',
                'Your File is Imported Successfully!',
                'success'
                )
            // location.reload();
            }

        }
      });
    });


    $('#DeleteModal').on('show.bs.modal', function(event) {

      var button = $(event.relatedTarget)
      var id = button.data('id')
      $('#delete_id').val(id);
    })
    $("#deleteCandidate").submit(function(event) {
      deleteForm();
      return false;
    });

    function deleteForm() {

      var data = $('form#deleteCandidate').serialize();
      $.ajax({
        type: "POST",
        url: "{{ route('deleteCandidate')}}",
        cache: false,
        data: $('form#deleteCandidate').serialize(),
        success: function(result) {
          $('#DeleteModal').modal('hide')
          Swal.fire({
            type: 'success',
            title: 'Candidate Deleted!',
            text: 'Candidate is Deleted Successfully ✨',
            showConfirmButton: false,
            timer: 2000
          })
          location.reload();

        },
        error: function() {
          alert("Error");
        }
      });
    }
    $("#candi_img").click(function() {
      $("#drag_drop_field")[0].click();
    });

    $("#pol_img").click(function() {
      $("#pol_party_logo")[0].click();
    });
    $("#update_edit_candidate_profile").click(function() {
      console.log('inside');
      $("#update_edit_candidate_profile > #edit_drag_drop_field")[0].click();
    });
    $("#update_edit_pol_profile").click(function() {
      $("#update_edit_pol_profile > #edit_pol_party")[0].click();
    });
    $(document).on('click','.update_filter_btn',function(){
      var form = $('#filterForm').serialize();
      $.LoadingOverlay("show");
      $('#filterForm')[0].reset();
    // $('select[name="Canton"],select[name="parroquia"]').attr('disabled','disabled');
      $.ajax({
        type: "GET",
        url: "{{ route('systemCandidates',['param'=>true])}}",
        cache: false,
        data: form,
        success: function(result) {
          $('#FIlterModal').modal('hide');
                  $.LoadingOverlay("hide");
                  if(result.result == 'fail')
                  {
                    Swal.fire({
                    type: 'danger',
                    // title: 'Success!',
                    text: result.msg,
                    showConfirmButton: false,
                    timer: 2000
                  })
                  }
                  if (result.errors) {
                    $.toaster({
                      priority: 'danger',
                      title: 'Wrong',
                      message: 'All Fields Required'
                    });
                  } else {
          var UserData = result.data;
          let getTabelData='';
          let userFullnames = UserData.map(function(element){
            if(element.candidate_img == null)
            {
              element.candidate_img = 'images/tianiaPress.png'
            }
            else{
              element.candidate_img = 'avatars/'+element.candidate_img;

            }
            getTabelData+=`<tr>
            <th scope="row" style="text-align: center;"><input type="checkbox" name="bulk_delete[]" class="checkbox_bulk" value="`+element.id+`"></th>
          <th scope="row" style="text-align: center;"><img src="{{ asset("`+element.candidate_img+`")}}" class="table_candidate_img"></th>

          <th scope="row">`+element.name+`</th>
          <td>`+element.pol_party+`</td>
          <td>`+element.phone+`</td>
          <td>`+element.email+`</td>
          <th scope="row">`+element.position+`</th>
          <td>`+element.state+`</td>
          <td>`+element.city+`</td>
          <td>`+element.parroquia+`</td>
          <td class="d-flex">
            <a href="#" class="mr-1 text-dark edit_delete_btn " data-id="`+element.id+`" data-toggle="modal" data-target="#EditModal"><i class="fa fal fa-edit"></i></a>
            <a href="#" class=" ml-1 text-dark edit_delete_btn" data-toggle="modal" data-id="`+element.id+`" data-target="#DeleteModal"><i class="fa far fa-trash-alt"></i></a>
          </td>
        </tr>`;
        $('#data_table_tbody').html(getTabelData);
          })
         }

        },
        error: function() {
          alert("Error");
        }
      });
    });

    // $('select[name="city"],select[name="parroquia"],select[name="zona"],select[name="circun"],select[name="junta_no"]').attr('disabled','disabled');  
    $('select[name=state]').on('change', function() {
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
            $('select[name=city]').html(html);
            $('select[name=city]').removeAttr('disabled');


        },
        error: function() {
          alert("Error");
        }
      });
    });

    $('select[name=city]').on('change', function() {
      var getValuecity = this.value;
      var getValueState = $('select[name=state] option:selected').val();
      console.log()

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
      var getValuecity = $('select[name=city] option:selected').val();

      // $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: "{{ route('getZonaValue')}}",
        data: {
          'getValuecity': getValuecity,
          'getValueState': getValueState,
          'getValueparroquia': getValueparroquia,
        },
        success: function(result) {
           // $.LoadingOverlay("hide");
           console.log(result.data[0].zone_name);
           var  html ='<option value="null">Choose...</option>';
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
    // $('.drag_drop_file').click(()=>{
    //     $('.drag_drop_file > input#drag_drop_field').click();
    // });
    // $('select[name="canton"],select[name="parroquia"],select[name="zona"],select[name="circun"],select[name="junta_no"]').attr('disabled','disabled');  
    console.log('sssasas');
    $('select[name=provincia]').on('change', function() {
      console.log('sss');
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
          var  html ='<option value="null">Choose...</option>';
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
          console.log(result);
           // $.LoadingOverlay("hide");
           var  html ='<option value="null">Choose...</option>';
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
           var  html ='<option value="null">Choose...</option>';
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
           var  html ='<option value="null">Choose...</option>';
           for (let i = 1; i <= femaleVoter; i++) {
                html += '<option  value="'+ i+'F'+'">' + i+'F' +'</option>';
            }
            $('select[name=junta_no]').append(html);

          var Malehtml ='';
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
    $('select[name=edit_state]').on('change', function() {
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
            $('select[name=edit_city]').html(html);
            $('select[name=edit_city]').removeAttr('disabled');


        },
        error: function() {
          alert("Error");
        }
      });
    });

    $('select[name=edit_city]').on('change', function() {
      var getValuecity = this.value;
      var getValueState = $('select[name=edit_state] option:selected').val();
      console.log()

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
            $('select[name=edit_parroquia]').html(html);
            $('select[name=edit_parroquia]').removeAttr('disabled');


        },
        error: function() {
          alert("Error");
        }
      });
    });

    $('select[name=edit_parroquia]').on('change', function() {
      var getValueparroquia = this.value;
      var getValueState = $('select[name=edit_state] option:selected').val();
      var getValuecity = $('select[name=edit_city] option:selected').val();

      // $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: "{{ route('getZonaValue')}}",
        data: {
          'getValuecity': getValuecity,
          'getValueState': getValueState,
          'getValueparroquia': getValueparroquia,
        },
        success: function(result) {
           // $.LoadingOverlay("hide");
           console.log(result.data[0].zone_name);
           var  html ='<option value="null">Choose...</option>';
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
  });
</script>
@endsection('javascript')