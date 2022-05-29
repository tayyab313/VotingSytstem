@extends('layouts.main')

@section('content')
@include('Admin.admintt')
<!-- Political party section -->
<div class="political_party_div">
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
                    <button  data-toggle="modal" data-target="#uploadModal" class="btn filter_btn Candidate_btns multi_btn"><i class="fa fa-download mr-1" aria-hidden="true"></i>Import
                    </button>
                    <a href="{{ route('exportElectionPPoliticalParty') }}" class="btn filter_btn Candidate_btns multi_btn"><i class="fa fa-upload mr-1" aria-hidden="true"></i>Export
                    </a>
                    <button  class="btn filter_btn Candidate_btns multi_btn" data-toggle="modal" data-target="#FIlterModal"><img  src="{{asset('images/filter_icon.png')}}" class="filter_icon">Filters
                    </button>
                    <button class="btn filter_btn Candidate_btns comon_color_btn AddCandidate" data-toggle="modal" data-target="#AddPartyModal"><i class="fa-solid fa-plus mr-1"></i>Add
                    </button>

                </div>
            </div>
        </div>
        <!-- </form> -->

    </div>
    <div class="table_div container-fluid">

        <table id="table_datatable" class="table">
            <thead class="table_head">
                <tr>
                <th style="display: flex;justify-content: center;"><input type="checkbox" name="Main_checkbox_bulk" class="Main_checkbox_bulk" "></th>
                    <th scope="col">Logo</th>
                    <th scope="col">Name of political party</th>
                    <th scope="col">Level</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id='data_table_tbody'>
                @foreach ($PoliticalParty as $PoliticalParties)
                <tr>
                    <th scope="row" style="text-align: center;"><input type="checkbox" name="bulk_delete[]" class="checkbox_bulk" value="{{$PoliticalParties->id}}"></th>
                    @if(!empty($PoliticalParties->party_logo))
                    <th scope="row"><img src="{{ asset("avatars/$PoliticalParties->party_logo")}}" class="table_candidate_img"></th>
                    @endif
                    @if($PoliticalParties->party_logo == null)
                    <th scope="row"><img src="{{asset('images/party_logo.png')}}" class="table_candidate_img"></th>
                    @endif
                    <td>{{$PoliticalParties->party_name}}</td>
                    <td>{{$PoliticalParties->party_level}}</td>
                    <td class="d-flex">
                        <a href="#" class=" ml-1 text-dark edit_delete_btn" data-toggle="modal" data-target="#DeleteModal" data-id="{{$PoliticalParties->id}}"><i class="fa far fa-trash-alt"></i></a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>


    </div>
    

    <!-- end here  -->

    <!-- end here -->
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
                        <img src="{{asset('images/delete_pic.png')}}" class="delete_image">
                        <p class="delete_text">Are you sure you want to delete?</p>
                        <input type="hidden" name="delete_id" id="delete_id" value="">
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary no_btn" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary comon_color_btn yes_btn delete_btn">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- end here -->
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
        <form method='post' action="{{ route('importElectionPPoliticalParty') }}" enctype="multipart/form-data">
          Select file : <input type='file' name='file' id='file' class='form-control' ><br>
          <input type='button' class='btn btn-info' value='Upload' id='btn_upload'>
        </form>
      </div>
 
    </div>

  </div>
</div>
<!-- side modal start here 
 -->

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
                <label for="NameOfPArty" class="">Name of Party</label>
                <select id="NameOfPArty" name="NameOfPArty" class="form-control">
                  <option disabled selected>Choose...</option>
                  @foreach ($PoliticalParty as $party)
                    <option value="{{$party['party_name']}}">{{$party['party_name']}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <label for="Level" class="">Level</label>
                <select id="Level" name="Level" class="form-control">
                  <option disabled selected>Choose...</option>
                  <!-- <option value="TownShip">TownShip</option> -->
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
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

 <!-- end here  -->
<div class="modal fade" id="AddPartyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog modal-dialog-centered m-auto" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Political Party</h5>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger " style="display:none"></div>
                    <div class="form_div w-100">
                        <form id="AddParty" name="AddParty">
                            @csrf
                            <div id="pol_img" class="form-group  political_party_logo">
                                <img src="{{asset('images/can_camera.png')}}" class="can_cam_image">
                                <img id="preview_pol_party" style="width: 78px;height: 83px;border-radius: 8px;position: relative;top: 8px;right: 0px;">
                                <p class="candidate_p_style">Political party logo</p>
                                <input type="file" class="form-control d-none" id="pol_party_logo" name="pol_party_logo" oninput="preview_pol_party.src=window.URL.createObjectURL(this.files[0])">

                            </div>
                            <div class="form-row mt-3">

                                <div class="form-group col-12">
                                    <label for="Political_Party" class="">Political Party</label>
                                    <input type="text" class="form-control" id="Political_Party" name="Political_Party" placeholder="Enter Party Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="level">Level</label>
                                    <select id="party_level" name="party_level" class="form-control">
                                        <option selected="true" disabled="disabled">Choose Level of Political Party</option>
                                        <option value="1">Level One</option>
                                        <option value="2">Level two</option>
                                        <option value="3">Level Three</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save_btn AddParty">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection('content')

@section('javascript')
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(()=>{
      $('select[name="Level"]').attr('disabled','disabled');  
    $('select[name=NameOfPArty]').on('change', function() {
      $('select[name="Level"]').removeAttr('disabled');  

    });
        $('#btn_upload').click(function(){
                $.LoadingOverlay("show");
                var fd = new FormData();
                var files = $('#file')[0].files[0];
                fd.append('file',files);

                // AJAX request
                $.ajax({
                url: "{{ route('importElectionPPoliticalParty')}}",
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){
      $.LoadingOverlay("hide");

                    if (response.errors) {
                  $.toaster({ priority :'danger', title :'Wrong', message :'Invalid File Format'});
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
            });
        $("#pol_img").click(function() {
            $("#pol_party_logo")[0].click();
        });
        $('#table_datatable').DataTable({
            language: {
                searchPlaceholder: "Search Tables",
                search: ''
            }
        });
        $(".AddParty").click(function(event) {
            event.preventDefault();
            $.LoadingOverlay("show");
            var form = $('#AddParty')[0];
            var formdata = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{ route('savePoliticalParty')}}",
                processData: false,
                contentType: false,
                cache: false,
                data: formdata,
                enctype: 'multipart/form-data',
                success: function(result) {
                    $.LoadingOverlay("hide");

                    if (result.errors) {
                        $.toaster({ priority :'danger', title :'Wrong', message :'All Fields Required'});
                    } else {
                        Swal.fire({
                            type: 'success',
                            title: 'Political Party Added!',
                            text: 'New Political Party is Added 🔥',
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
        });

        $('#DeleteModal').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget)
            var id = button.data('id')
            $('#delete_id').val(id);
        })
        $('.delete_btn').click(() => {
            event.preventDefault();
            let get_id = $('#delete_id').val();
            $.ajax({
                type: "POST",
                url: "{{ route('deletePoliticalPparty')}}",
                cache: false,
                data: {
                    'get_id': get_id
                },
                success: function(result) {
                    $('#DeleteModal').modal('hide')
                    Swal.fire({
                        type: 'success',
                        title: 'Political Party Deleted!',
                        text: 'Political Party is Deleted Successfully ✨',
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
        $(document).on('click','.update_filter_btn',function(){
            var form = $('#filterForm').serialize();
            $.LoadingOverlay("show");
            $('#filterForm')[0].reset();
            $('select[name="Level"]').attr('disabled','disabled');  
            $.ajax({
                type: "GET",
                url: "{{ route('PPElection',['id'=>'id','param'=>true])}}",
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
                let party_logo_Val='';
                let userFullnames = UserData.map(function(element){
                    if(element.party_logo !=null)
                    {
                        party_logo_Val = 'avatars/'+element.party_logo;

                    }
                    else{
                        party_logo_Val = 'images/party_logo.png';
                    }
                    getTabelData+=`<tr>
              <th scope="row" style="text-align: center;"><input type="checkbox" name="bulk_delete[]" class="checkbox_bulk" value="`+element.id+`"></th>
                    <th scope="row"><img src="{{ asset("`+party_logo_Val+`")}}" class="table_candidate_img"></th>
                    <td>`+element.party_name+`</td>
                    <td>`+element.party_level+`</td>
                    <td class="d-flex">
                        <a href="#" class=" ml-1 text-dark edit_delete_btn" data-toggle="modal" data-target="#DeleteModal" data-id="`+element.id+`"><i class="fa far fa-trash-alt"></i></a>
                    </td>
                </tr>`;
                console.log(getTabelData);
                $('#data_table_tbody').html(getTabelData);
                })
              }

                },
                error: function() {
                alert("Error");
                }
            });
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
              url:"{{route('bulkDeleteElectPolticalParty')}}",
              method:'get',
              data:{id:id},
              success:function(data)
              {
                $.LoadingOverlay("hide");
                Swal.fire({
                  type: 'success',
                  title: 'Deleted!',
                  text: 'Table Deleted Successfully✨',
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
    });

</script>
@endsection('javascript')