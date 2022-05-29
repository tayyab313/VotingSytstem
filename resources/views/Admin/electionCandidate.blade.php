@extends('layouts.main')

@section('content')
@include('Admin.admintt')
<!-- Main Content Here -->
<!-- Main adminData Here -->
<!-- tables section -->
<!-- candidates section -->
<div class="candidate_section_div ">
  <div class="document_heading container-fluid">
    <!-- <form > -->
    <div class="form-row mt-3">
      <!-- <div class="form-group col-sm-12 col-md-4 col-lg-4 has-search">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text" class="form-control" id="search" name="search"
                                placeholder="Search Candidate">

                        </div> -->
      <div class="btn_parent_div form-group col-sm-12  col-md-12 col-lg-12 d-flex justify-content-end ">
        <div class="row">
          <button class="btn filter_btn Candidate_btns multi_btn " id="bulk_delete"><i class="fas fa fa-trash-alt"></i> Bulk Delete
          </button>
          <button data-toggle="modal" data-target="#uploadModal" class="btn filter_btn Candidate_btns multi_btn"><i class="fa fa-download mr-1" aria-hidden="true"></i>Import
          </button>
          <a href="{{ route('exportElectionCandidates') }}" class="btn filter_btn Candidate_btns multi_btn"><i class="fa fa-upload mr-1" aria-hidden="true"></i>Export
          </a>
          <button class="btn filter_btn Candidate_btns multi_btn" data-toggle="modal" data-target="#FIlterModal"><img src="{{asset('images/filter_icon.png')}}" class="filter_icon"> Filters
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
                                <th scope=" col">Name</th>
          <th scope="col">Political Party</th>
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
        @if(isset($electionDetails))
        @foreach($electionDetails as $elec)
        <tr data-id="{{ $elec->id}}">
          <th scope="row" style="text-align: center;"><input type="checkbox" name="bulk_delete[]" class="checkbox_bulk" value="{{$elec->id}}"></th>

          <th scope="row">{{ $elec->name}}</th>
          <td>{{ $elec->political_party}}</td>
          <td>{{ $elec->phone}}</td>
          <td>{{ $elec->email}}</td>
          <th>{{ $elec->position}}</th>
          <td>{{ $elec->state}}</td>
          <td>{{ $elec->city}}</td>
          <td>{{ $elec->parroquia}}</td>
          <td class="d-flex">
            <a data-id="{{ $elec->id}}" class=" ml-1 text-dark edit_delete_btn" data-id="{{$elec->id}}" data-toggle="modal" data-target="#DeleteModal" style="cursor:pointer"><i class="fa far fa-trash-alt"></i></a>
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>


  </div>
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
          <form method='post' action='{{ route('importCandidate') }}' enctype="multipart/form-data">
            Select file : <input type='file' name='file' id='file' class='form-control'><br>
            <input type='button' class='btn btn-info' value='Upload' id='btn_upload'>
          </form>
        </div>

      </div>

    </div>
  </div>
</div>
<!-- end here -->
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
                  @foreach ($getSTatVal as $val)
                      <option value="{{$val['state_name']}}">{{$val['state_name']}}</option>
                      @endforeach
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <label for="canton" class="">Canton</label>
                <select id="canton" name="canton" class="form-control">
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
          <button type="button" class="btn btn-primary comon_color_btn yes_btn delete_btn">Yes</button>
      </form>
    </div>
  </div>
</div>
<!-- <div id="uploadModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Upload Candidate</h4>

                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method='post' action='{{ route('importCandidate') }}' enctype="multipart/form-data">
                        Select file : <input type='file' name='file' id='file' class='form-control' ><br>
                        <input type='button' class='btn btn-info' value='Upload' id='btn_upload'>
                        </form>
                    </div>
                
                    </div>

                </div>
            </div> -->

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
    $(document).on("click", ".edit_delete_btn", function() {
      var getId = $(this).attr('data-id');
      $('input#delete_id').val(getId);
    });
    $(document).on('click', '.delete_btn', function() {
      var getTableId = $('input#delete_id').val();
      $.ajax({
        type: "POST",
        url: "{{ route('electionCandidateDelete')}}",
        data: {
          'id': getTableId
        },
        success: function(result) {
          $.LoadingOverlay("hide");
          $('#DeleteModal').modal('hide');
          Swal.fire({
            type: 'success',
            title: 'Delete!',
            text: 'Election Candidate Delete successfully  🔥',
            showConfirmButton: false,
            timer: 4000
          })
          setTimeout(() => {
            // $('.modal-backdrop').remove();
            // $('#table_datatable tr[data-id="'+getTableId+'"]').remove();
            location.reload();
          }, 2000);

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
      var electionId = "{{ session()->get('electionId') }}";
      fd.append('election_id', electionId);

      // AJAX request
      $.ajax({
        url: "{{ route('importElectionCandidate')}}",
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
    });

    $(document).on('click', '.update_filter_btn', function() {
      var form = $('#filterForm').serialize();
      $.LoadingOverlay("show");
      $('#filterForm')[0].reset();
      $.ajax({
        type: "GET",
        url: "{{ route('candidateElection',['id'=>'id','param'=>true])}}",
        cache: false,
        data: form,
        success: function(result) {
          $('#FIlterModal').modal('hide');
          $.LoadingOverlay("hide");
          if (result.result == 'fail') {
            Swal.fire({
              type: 'danger',
              // title: 'Success!',
              text: result.msg + '🔥',
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
            console.log(UserData);
            let getTabelData = '';
            let userFullnames = UserData.map(function(element) {
              getTabelData += `<tr>
              <th scope="row" style="text-align: center;"><input type="checkbox" name="bulk_delete[]" class="checkbox_bulk" value="`+element.id+`"></th>
          <th scope="row">` + element.name + `</th>
          <td>` + element.political_party + `</td>
          <td>` + element.phone + `</td>
          <td>` + element.email + `</td>
          <th scope="row">` + element.position + `</th>
          <td>` + element.state + `</td>
          <td>` + element.city + `</td>
          <td>` + element.parroquia + `</td>
          <td class="d-flex">
            <a href="#" class="mr-1 text-dark edit_delete_btn " data-id="` + element.id + `" data-toggle="modal" data-target="#EditModal"><i class="fa fal fa-edit"></i></a>
            <a href="#" class=" ml-1 text-dark edit_delete_btn" data-toggle="modal" data-id="` + element.id + `" data-target="#DeleteModal"><i class="fa far fa-trash-alt"></i></a>
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
    $('.Main_checkbox_bulk').click(function(e) {
      if ($('.Main_checkbox_bulk:checked')) {
        $('.checkbox_bulk').prop("checked", true);
      }
      if ($('.Main_checkbox_bulk').prop('checked') == false) {
        $('.checkbox_bulk').prop("checked", false);

      }
    });
    $(document).on('click', '#bulk_delete', function(e) {
      var id = [];
      if (confirm('Are you sure to delete this data ?')) {
        $('.checkbox_bulk:checked').each(function(e) {
          id.push($(this).val());
        });
        if (id.length > 0) {
          $.LoadingOverlay("show");
          $.ajax({
            url: "{{route('bulkDeleteElectCan')}}",
            method: 'get',
            data: {
              id: id
            },
            success: function(data) {
              $.LoadingOverlay("hide");
              Swal.fire({
                type: 'success',
                title: 'Deleted!',
                text: 'Candidate Deleted Successfully✨',
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
    $('select[name="canton"],select[name="parroquia"],select[name="zona"],select[name="circun"],select[name="junta_no"]').attr('disabled','disabled');  
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
          console.log(result);
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