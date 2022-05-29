@extends('layouts.main')

@section('content')

<div class="main_content mt-2">
  <div class="breadCrumbs">
    <ul class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li>Staff</li>
    </ul>
  </div>
  <div class="container-fluid">
    <h2 class="heading_candidate">Staff</h2>
  </div>
  <div class="document_heading container-fluid">
    <!-- <form > -->
    <!-- <div class="form-row mt-3">
                <div class="form-group col-sm-12 col-md-4 col-lg-4 has-search">
                  <span class="fa fa-search form-control-feedback"></span>
                    <input type="search" class="form-control" id="search" name="search" placeholder="Search Candidate">

                </div> -->
    <div class="btn_parent_div form-group col-sm-12  col-md-12 col-lg-12 d-flex justify-content-end ">
      <div class="row">
        <button class="btn filter_btn Candidate_btns multi_btn " id="bulk_delete"><i class="fas fa fa-trash-alt"></i> Bulk Delete
        </button>
        <button data-toggle="modal" data-target="#uploadModal" class="btn filter_btn Candidate_btns multi_btn"><i class="fa fa-download mr-1" aria-hidden="true"></i>Import
        </button>
        <a href="{{route('exportStaffMemberfunction')}}" class="btn filter_btn Candidate_btns multi_btn"><i class="fa fa-upload mr-1" aria-hidden="true"></i>Export
        </a>
        <button class="btn filter_btn Candidate_btns multi_btn" data-toggle="modal" data-target="#FIlterModal"><i class="fa fa-filter mr-1" aria-hidden="true"></i>New Search
        </button>
        <button class="btn filter_btn Candidate_btns comon_color_btn AddCandidate" data-toggle="modal" data-target="#addModal"><i class="fa-solid fa-plus mr-1"></i>New Staff Member
        </button>
      </div>
    </div>
  </div>
  <!-- </form> -->

</div>
<div class="table_div container-fluid" style="align-items: inherit;">

  <table class="table" id="datatabel">
    <thead class="table_head">
      <tr>
        <th style="display: flex;justify-content: center;"><input type="checkbox" name="Main_checkbox_bulk" class="Main_checkbox_bulk"></th>
        <th scope="col">Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Email ID</th>
        <th scope="col">Position</th>
        <th scope="col">Provincia</th>
        <th scope="col">Canton</th>
        <th scope="col">Parroquias</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody id="data_table_tbody">
      @foreach ($User as $userData)
      <tr data-id="{{$userData['id']}}">
        <th scope="row" style="text-align: center;"><input type="checkbox" name="bulk_delete[]" class="checkbox_bulk" value="{{$userData['id']}}"></th>
        @if(isset($userData->candidate_img))
        <th scope="row"><img src="{{ asset("avatars/$userData->candidate_img")}}" class="table_candidate_img">{{$userData['name']}}</th>
        @else
        <th scope="row"><img src="images/tianiaPress.png" class="table_candidate_img">{{$userData['name']}}</th>
        @endif
        <td>{{$userData['phone']}}</td>
        <td>{{$userData['email']}}</td>
        <th scope="row">{{$userData['position']}}</th>
        <td>{{$userData['state']}}</td>
        <td>{{$userData['city']}}</td>
        <td>{{$userData['parroquia']}}</td>
        <td class="d-flex"><a href="#" class="mr-1 text-dark edit_delete_btn " data-toggle="modal" data-target="#EditModal" data-id="{{$userData['id']}}"><i class="fa fal fa-edit"></i></a><a href="#" class=" ml-1 text-dark _delete_btn" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{$userData['id']}}"><i class="fa far fa-trash-alt"></i></a></td>
      </tr>
      @endforeach

    </tbody>
  </table>


</div>
</div>

</div>
<!-- modals -->
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Upload Candidate</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form method='post' action='{{ route('importStaff') }}' enctype="multipart/form-data">
          Select file : <input type='file' name='file' id='file' class='form-control'><br>
          <input type='button' class='btn btn-info' value='Upload' id='btn_upload'>
        </form>
      </div>

    </div>

  </div>
</div>
<!-- delete modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="delete_modal modal-dialog modal-dialog-centered m-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close  " data-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-center align-items-center flex-column">
        <input type="hidden" class="form-control" id="ID" name="ID">
        <img src="{{asset('images/delete_pic.png')}}" class="delete_image">
        <p class="delete_text">Are you sure you want to delete?</p>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary no_btn" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary comon_color_btn yes_btn">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- end here -->

<!-- add modal -->



<!-- side modal start here -->

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
                  <option disabled selected>Choose...</option>
                  @foreach ($getSTatVal as $getSTatVals)
                  <option value="{{$getSTatVals['state_name']}}">{{$getSTatVals['state_name']}}</option>
                    
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <label for="Canton" class="">Canton</label>
                <select id="Canton" name="Canton" class="form-control">
                  <option disabled selected>Choose...</option>
                  <option value="canto">Canto</option>
                  <option value="cantcao">Cantcao</option>
                  <option value="canto juanid">Canto juanid</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <label for="parroquia" class="">Parroquia</label>
                <select id="parroquia" name="parroquia" class="form-control">
                  <option disabled selected>Choose...</option>
                  <option value="parroquia">Parroquia</option>
                  <option value="parroqcacauia">Parroqcacauia</option>
                  <option value="parroquia junaid">Parroquia junaid</option>
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
<!-- end here -->
<!-- EDIT MODAL -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog modal-dialog-centered m-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Staff member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form_div w-100">
          <form id="ediFormProfile">
            @csrf
            <div class="form-row mt-3 d-flex flex-row ">
              <input type="hidden" id="staffID" name="staffID" value="">
              <div class="form-group  political_party_logo" id="update_edit_pol_profile">
                <img src="images/can_camera.png" class="can_cam_image">
                <img id="edit_preview_pol_img" style="width: 78px;height: 83px;border-radius: 8px;position: relative;top: 3px;right: 0px;">
                <p class="candidate_p_style">Staff Picture</p>
                <input type="file" class="form-control d-none drag_drop_file" id="edit_pol_party" name="edit_pol_party" oninput="edit_preview_pol_img.src=window.URL.createObjectURL(this.files[0])">

              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <label for="updated_name">Name</label>
                <input type="text" class="form-control" id="updated_name" name="updated_name" placeholder="Enter">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <label for="updated_phone">Phone</label>
                <input type="text" class="form-control" id="updated_phone" name="updated_phone" placeholder="Enter">
              </div>
              <div class="form-group col-6">
                <label for="updated_email">Email ID</label>
                <input type="text" class="form-control" id="updated_email" name="updated_email" placeholder="Enter" disabled>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <label for="updated_Position" class="">Position</label>
                <select id="updated_Position" name="updated_Position" class="form-control">
                  <option value="null" selected>Choose...</option>
                  @foreach ($positons as $positionVal)
                  <option value="{{$positionVal['position_val']}}">{{$positionVal['position_val']}}</option>
                    
                  @endforeach
                </select>
              </div>
              <div class="form-group col-6">
                <label for="updated_State" class="">Provincia</label>
                <select id="updated_State" name="updated_State" class="form-control">
                  <option value="null" selected>Choose...</option>
                 
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <label for="updated_City" class="">Canton</label>
                <select id="updated_City" name="updated_City" class="form-control">
                  <option value="null" selected>Choose...</option>
                 
                </select>
              </div>
              <div class="form-group col-6">
                <label for="updated_Parroquias" class="">Parroquias</label>
                <select id="updated_Parroquias" name="updated_Parroquias" class="form-control">
                  <option value="null" selected>Choose...</option>
                  
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary UpdateProfile_btn mark_hover">Update</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog modal-dialog-centered m-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add Staff member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form_div w-100">
          <form id="addStaffMember">
            <div class="form-row mt-3 d-flex flex-row ">
              <div id="staff_img" class="form-group  political_party_logo">
                <img src="{{asset('images/can_camera.png')}}" class="can_cam_image">
                <img id="preview_pol_party" style="width: 78px;height: 83px;border-radius: 8px;position: relative;top: 3px;right: 0px;">
                <p class="candidate_p_style">Staff Picture</p>
                <input type="file" class="form-control d-none" id="staff_logo" name="staff_logo" oninput="preview_pol_party.src=window.URL.createObjectURL(this.files[0])">

              </div>
            </div>
            <div class="form-row mt-3">
              <div class="form-group col-12">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" maxlength="12" placeholder="Enter">
              </div>
              <div class="form-group col-6">
                <label for="email">Email ID</label>
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
                <label for="City" class="">Canton</label>
                <select id="City" name="City" class="form-control">
                  <option value="null" selected>Choose...</option>
                  <option value="lahore">Lahore</option>
                  <option value="karachi">karachi</option>
                  <option value="sindh">sindh</option>
                  <option value="Isb">Isb</option>
                  <option value="balochistan">balochistan</option>
                </select>
              </div>
              <div class="form-group col-6">
                <label for="Parroquias" class="">Parroquias</label>
                <select id="Parroquias" name="Parroquias" class="form-control">
                  <option value="null" selected>Choose...</option>
                  <option value="Pakistan">Pakistan</option>
                  <option value="INdea">INdea</option>
                  <option value="Dubai">Dubai</option>
                  <option value="London">London</option>
                  <option value="Germany">Germany</option>
                  <option value="UK">UK</option>
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary AddStaffBtn mark_hover">Add</button>
      </div>
    </div>
  </div>
</div>
@endsection('content')

@section('javascript')
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).ready(() => {
        $("#staff_img").click(function() {
          $("#staff_logo")[0].click();
        });
        $("#update_edit_pol_profile").click(function() {
          $('#edit_preview_pol_img').removeClass('d-none');
          $("#update_edit_pol_profile > #edit_pol_party")[0].click();
        });
        $('#datatabel').DataTable({
          language: {
            searchPlaceholder: "Search Tables",
            search: ''
          }
        });
        $('.Drag_drop_file').click(() => {
          // alert(2323);
          $('.Drag_drop_file > input#Drag_drop_field').click();
        });
        $('.AddCandidate').click(() => {
          $('#AddModal').modal('show');

        });
        $(document).on('click', '._delete_btn', function() {
          var getID = $(this).attr('data-id');
          console.log(getID);
          $('#ID').val(getID);
        });
        $('.yes_btn').click(() => {
          event.preventDefault();
          let get_id = $('#ID').val();
          $.ajax({
            type: "POST",
            url: "{{ route('deleteStaff')}}",
            cache: false,
            data: {
              'get_id': get_id
            },
            success: function(result) {
              $('#DeleteModal').modal('hide')
              Swal.fire({
                type: 'success',
                title: 'Deleted!',
                text: 'Staff Member is Deleted Successfully ✨',
                showConfirmButton: false,
                timer: 4000
              })
              setTimeout(() => {
                location.reload();
              }, 2000);

            },
            error: function() {
              alert("Error");
            }
          });
        });
        $(document).on('click', '.edit_delete_btn', function() {
          var staff_Id = $(this).attr('data-id');
          console.log(staff_Id);
          $('#staff_id').val(staff_Id);
          //   $('#StaffID').val(staff_Id);
          $.ajax({
            type: "GEt",
            url: "{{ route('editStaffMember')}}",
            data: {
              'id': staff_Id
            },
            success: function(result) {
              console.log(result.data);
              $('#updated_name').val(result.data.name);
              $('#updated_email').val(result.data.email);
              $('#updated_phone').val(result.data.phone);
              $('#updated_City').html('<option selected value="'+result.data.city+'">'+result.data.city+'</option>');
              // $('#updated_City').attr('disabled','disabled');
              // $('#updated_Parroquias').attr('disabled','disabled');
              $('#updated_Parroquias').html('<option selected value="'+result.data.parroquia+'">'+result.data.parroquia+'</option>');
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
              $('#updated_State').html(getStateData);
              var selected = '';
              var getTabelData='<option selected >Choose...</option>';
              let userFullnames = UserData.map(function(element){
                if(element.position_val === result.data.position)
                {
                  selected='selected';
                }
                getTabelData+=`<option value='`+element.position_val+`' `+selected+`>`+element.position_val+`</option>`;
                selected='';
              })
              $('#updated_Position').html(getTabelData);
              // $('#updated_Position option[value="' + result.data.position + '"]').attr('selected', 'selected');
              localStorage.setItem("StaffId", result.data.id);
              $('input#StaffID').val(localStorage.getItem("StaffId"))
              if (result.data.candidate_img != null) {
                console.log(result.data.candidate_img);
                $('#edit_preview_pol_img').removeClass('d-none');
                $('#edit_preview_pol_img').attr('src', `{{asset('avatars/` + result.data.candidate_img + `')}}`);

              } else {
                // $('#edit_preview_pol_img').addClass('d-none');
                $('#edit_preview_pol_img').removeAttr('src', "");
                $('#edit_preview_pol_img').attr('src', "{{asset('images/tianiaPress.png')}}");
                // $('#').removeAttr('src');

              }
              $.LoadingOverlay("hide");


            },
            error: function() {
              alert("Error");
            }
          });
        });
        $('select[name=updated_State]').on('change', function() {
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
                $('select[name=updated_City]').html(html);
                $('select[name=updated_City]').removeAttr('disabled');


            },
            error: function() {
              alert("Error");
            }
          });
        });

        $('select[name=updated_City]').on('change', function() {
          var getValuecity = this.value;
          var getValueState = $('select[name=updated_State] option:selected').val();
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
                html = "";
                $.each(result.data, function( index, value ) {
                    html += '<option  value="'+ value.parroquia_name +'">' + value.parroquia_name +'</option>';
                });
                $('select[name=updated_Parroquias]').html(html);
                $('select[name=updated_Parroquias]').removeAttr('disabled');


            },
            error: function() {
              alert("Error");
            }
          });
        });

        $('select[name=updated_Parroquias]').on('change', function() {
          var getValueparroquia = this.value;
          var getValueState = $('select[name=updated_State] option:selected').val();
          var getValuecity = $('select[name=updated_City] option:selected').val();

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
        $(document).on('click', '.update_filter_btn', function() {
            var form = $('#filterForm').serialize();
            $.LoadingOverlay("show");
            $('#filterForm')[0].reset();
            $.ajax({
                type: "GET",
                url: "{{ route('StaffMember',['param'=>true])}}",
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
                    let getTabelData = '';
                    let staff_img = '';
                    let userFullnames = UserData.map(function(element) {
                      if (element.candidate_img != null) {
                        staff_img = 'avatars/' + element.candidate_img;

                      } else {
                        staff_img = 'images/tianiaPress.png';
                      }
                      getTabelData += `<tr data-id="` + element.id + `">
                      <th scope="row" style="text-align: center;"><input type="checkbox" name="bulk_delete[]" class="checkbox_bulk" value="`+element.id+`"></th>
                      <th scope="row"><img src="{{ asset("` + staff_img + `")}}" class="table_candidate_img">` + element.name + `</th>
                      <td>` + element.phone + `</td>
                      <td>` + element.email + `</td>
                      <th scope="row">` + element.position + `</th>
                      <td>` + element.state + `</td>
                      <td>` + element.city + `</td>
                      <td>` + element.parroquia + `</td>
                      <td class="d-flex"><a href="#" class="mr-1 text-dark edit_delete_btn " data-toggle="modal" data-target="#EditModal" data-id="` + element.id + `"><i class="fa fal fa-edit"></i></a><a href="#" class=" ml-1 text-dark _delete_btn" data-toggle="modal" data-target="#exampleModalCenter" data-id="` + element.id + `"><i class="fa far fa-trash-alt"></i></a></td>
                  </tr>`;
                      $('#data_table_tbody').html(getTabelData);
                    })
                  }

                  },
                  error: function() {
                    alert("Error");
                  }
                });
            }); $('.AddStaffBtn').click(() => {
            event.preventDefault();
            $.LoadingOverlay("show");
            var form = $('#addStaffMember')[0];
            var formdata = new FormData(form);
            console.log(formdata + 'test');
            $.ajax({
              type: "POST",
              url: "{{ route('addStaffMember')}}",
              processData: false,
              contentType: false,
              cache: false,
              data: formdata,
              enctype: 'multipart/form-data',
              success: function(result) {
                $.LoadingOverlay("hide");

                if (result.errors) {
                  $.toaster({
                    priority: 'danger',
                    title: 'Wrong',
                    message: 'All Fields Required'
                  });
                } else {
                  Swal.fire({
                    type: 'success',
                    title: 'Success!',
                    text: 'Staff Member is Added 🔥',
                    showConfirmButton: false,
                    timer: 4000
                  })
                  setTimeout(() => {
                    location.reload();
                  }, 2000);
                }
              },
              error: function() {
                alert("Error");
              }
            });

          }); $('.UpdateProfile_btn').click(() => {
            $.LoadingOverlay("show");

            var form = $('#ediFormProfile')[0];
            var formdata = new FormData(form);
            formdata.append('StaffId', localStorage.getItem("StaffId"));
            $.ajax({
              type: "POST",
              url: "{{ route('UpdateStaffMemberProfile')}}",
              processData: false,
              contentType: false,
              cache: false,
              data: formdata,
              enctype: 'multipart/form-data',
              success: function(result) {
                $.LoadingOverlay("hide");

                if (result.errors) {
                  $.toaster({
                    priority: 'danger',
                    title: 'Wrong',
                    message: 'All Fields Required'
                  });

                } else {
                  Swal.fire({
                    type: 'success',
                    title: 'Success!',
                    text: 'Staff Member Is Updated Successfully 🔥',
                    showConfirmButton: false,
                    timer: 4000
                  })
                  setTimeout(() => {
                    location.reload();
                  }, 2000);
                }
                $("#AddPartyModal").modal('hide');
              },
              error: function() {
                alert("Error");
              }
            });
          }); $('#btn_upload').click(function() {
              $.LoadingOverlay("show");
            var fd = new FormData();
            var files = $('#file')[0].files[0];
            fd.append('file', files);

            // AJAX request
            $.ajax({
              url: "{{ route('importStaff')}}",
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function(response) {
                $.LoadingOverlay("hide");
                if (response.errors) {
                  $.toaster({
                    priority: 'danger',
                    title: 'Wrong',
                    message: 'Invalid File Format'
                  });
                } else {
                  $('#uploadModal').modal('hide');
                  Swal.fire(
                    'File Uploaded!',
                    'Your File is Imported Successfully!',
                    'success'
                  )
                  location.reload();
                }

              }
            });
          }); $('.Main_checkbox_bulk').click(function(e) {
            if ($('.Main_checkbox_bulk:checked')) {
              $('.checkbox_bulk').prop("checked", true);
            }
            if ($('.Main_checkbox_bulk').prop('checked') == false) {
              $('.checkbox_bulk').prop("checked", false);

            }
          }); $(document).on('click', '#bulk_delete', function(e) {
            var id = [];
            if (confirm('Are you sure to delete this data ?')) {
              $('.checkbox_bulk:checked').each(function(e) {
                id.push($(this).val());
              });
              if (id.length > 0) {
                $.LoadingOverlay("show");
                $.ajax({
                  url: "{{route('bulkDeleteStaff')}}",
                  method: 'get',
                  data: {
                    id: id
                  },
                  success: function(data) {
                    $.LoadingOverlay("hide");
                    Swal.fire({
                      type: 'success',
                      title: 'Deleted!',
                      text: 'Staff Deleted Successfully✨',
                      showConfirmButton: false,
                      timer: 2000
                    })
                    location.reload();
                  }
                });
              } else {
                alert('Please select atleast one checkbox');
              }
            }
          });
          $('select[name="Canton"],select[name="parroquia"],select[name="zona"],select[name="circun"],select[name="junta_no"]').attr('disabled','disabled');  
    $('select[name=provincia]').on('change', function() {
      console.log('inside ');
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
            $('select[name=Canton]').html(html);
            $('select[name=Canton]').removeAttr('disabled');


        },
        error: function() {
          alert("Error");
        }
      });
    });

    $('select[name=Canton]').on('change', function() {
      var getValuecity = this.value;
      var getValueState = $('select[name=provincia] option:selected').val();
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
      var getValuecity = $('select[name=Canton] option:selected').val();

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
    // $('.drag_drop_file').click(()=>{
    //     $('.drag_drop_file > input#drag_drop_field').click();
    // });
    $('select[name="City"],select[name="Parroquias"]').attr('disabled','disabled');  
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
          html = "";
            $.each(result.data, function( index, value ) {
                html += '<option  value="'+ value.city_name +'">' + value.city_name +'</option>';
            });
            $('select[name=City]').html(html);
            $('select[name=City]').removeAttr('disabled');


        },
        error: function() {
          alert("Error");
        }
      });
    });

    $('select[name=City]').on('change', function() {
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
            html = "";
            $.each(result.data, function( index, value ) {
                html += '<option  value="'+ value.parroquia_name +'">' + value.parroquia_name +'</option>';
            });
            $('select[name=Parroquias]').html(html);
            $('select[name=Parroquias]').removeAttr('disabled');


        },
        error: function() {
          alert("Error");
        }
      });
    });

    $('select[name=Parroquias]').on('change', function() {
      var getValueparroquia = this.value;
      var getValueState = $('select[name=state] option:selected').val();
      var getValuecity = $('select[name=City] option:selected').val();

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
    $('select[name="Canton"],select[name="Parroquia"],select[name="zona"],select[name="circun"],select[name="junta_no"]').attr('disabled','disabled');  
    console.log('sssasas');
    // $('select[name=State]').on('change', function() {
    //   console.log('sss');
    //   var getValueOption = this.value;
    //   // $.LoadingOverlay("show");
    //   $.ajax({
    //     type: "POST",
    //     url: "{{ route('getcityval')}}",
    //     data: {
    //       'getValueOption': getValueOption
    //     },
    //     success: function(result) {
    //       // $.LoadingOverlay("hide");
    //       html = "";
    //         $.each(result.data, function( index, value ) {
    //             html += '<option  value="'+ value.city_name +'">' + value.city_name +'</option>';
    //         });
    //         $('select[name=City]').html(html);
    //         $('select[name=City]').removeAttr('disabled');


    //     },
    //     error: function() {
    //       alert("Error");
    //     }
    //   });
    // });

    // $('select[name=City]').on('change', function() {
    //   var getValuecity = this.value;
    //   var getValueState = $('select[name=provincia] option:selected').val();

    //   // $.LoadingOverlay("show");
    //   $.ajax({
    //     type: "POST",
    //     url: "{{ route('getparroquiaval')}}",
    //     data: {
    //       'getValuecity': getValuecity,
    //       'getValueState': getValueState,
    //     },
    //     success: function(result) {
    //       console.log(result);
    //        // $.LoadingOverlay("hide");
    //         html = "";
    //         $.each(result.data, function( index, value ) {
    //             html += '<option  value="'+ value.parroquia_name +'">' + value.parroquia_name +'</option>';
    //         });
    //         $('select[name=Parroquia]').html(html);
    //         $('select[name=Parroquia]').removeAttr('disabled');


    //     },
    //     error: function() {
    //       alert("Error");
    //     }
    //   });
    // });

    // $('select[name=Parroquia]').on('change', function() {
    //   var getValueParroquia = this.value;
    //   var getValueState = $('select[name=provincia] option:selected').val();
    //   var getValueCity = $('select[name=City] option:selected').val();

    //   // $.LoadingOverlay("show");
    //   $.ajax({
    //     type: "POST",
    //     url: "{{ route('getZonaValue')}}",
    //     data: {
    //       'getValuecity': getValueCity,
    //       'getValueState': getValueState,
    //       'getValueParroquia': getValueParroquia,
    //     },
    //     success: function(result) {
    //        // $.LoadingOverlay("hide");
    //        console.log(result.data[0].zone_name);
    //        var html = "";
    //        if(result.data[0].zone_name == 'null' || result.data[0].zone_name == null)
    //        {
    //          console.log('inside if ');
    //         html = "<option  value='null'>Empty</option>";
    //         console.log(html);
    //         $('select[name=zona]').html(html);
    //        }
    //        else{
    //         $.each(result.data, function( index, value ) {
    //             html += '<option  value="'+ value.zone_name +'">' + value.zone_name +'</option>';
    //         });
    //         $('select[name=zona]').html(html);

    //        }

    //         $('select[name=zona]').removeAttr('disabled');


    //     },
    //     error: function() {
    //       alert("Error");
    //     }
    //   });
    // });
    $('select[name=zona]').on('change', function() {
      $('select[name=circun]').removeAttr('disabled');

    });

    $('select[name=circun]').on('change', function() {
      var getValuecircun    = this.value;
      var getValueState     = $('select[name=provincia] option:selected').val();
      var getValueCity    = $('select[name=City] option:selected').val();
      var getValueParroquia = $('select[name=Parroquia] option:selected').val();
      var getValuezona      = $('select[name=zona] option:selected').val();

      // $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: "{{ route('getJuntaValue')}}",
        data: {
          'getValuecircun': getValuecircun,
          'getValueState': getValueState,
          'getValueCity': getValueCity,
          'getValuezona': getValuezona,
          'getValueParroquia': getValueParroquia,
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