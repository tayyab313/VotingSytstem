@extends('layouts.main')

@section('content')
<div class="main_content mt-5">
@if(!empty(session()->has('message')))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
  <strong>Success!</strong> {{ session()->get('message') }}.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
    <div class="document_heading container-fluid d-flex justify-content-between">
        <p class="document_paragraph">Documents</p>
        @if(Auth::user()->role == 'Staff')
        <a  href="{{route('uploadDocument')}}" class="btn filter_btn comon_color_btn upload_btn">
            <i class="fa-solid fa-plus"></i>
            Upload Documents</a>
            @endif
    </div>
    <div class="table_div container-fluid">

        <table class="table " id="datatable_table">
            <thead class="table_head">
              <tr>
                <th scope="col">Document name</th>
                <th scope="col">Status</th>
                <th scope="col">Time</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($docs as $doc)
              <tr>
                <th scope="row"><a href="{{ route('viewDocument',['id' => Crypt::encrypt($doc->id)])}}" class="election_link">{{ $doc->doc_name }}</a></th>
                @if ( $doc['valid_votes']+$doc['null_votes']+$doc['blank_votes'] <= $doc['total_votes'])
                <td><span class="badge badge-pill success_badge">Valid</span></td>
                @endif
                @if ($doc['valid_votes']+$doc['null_votes']+$doc['blank_votes'] > $doc['total_votes'])
                <td><span class="badge badge-pill danger_badge">In Valid</span></td>
                @endif
                <td>{{ date("g:i a", strtotime($doc->doc_start_time))  }}</td>
                <td>{{ $doc->created_at->format('Y-m-d')  }}</td>
                <td class="d-flex">
                  <a href="{{ route('editDocument',['id' => Crypt::encrypt($doc->id)])}}" class="mr-2 text-dark"><i class="fa fal fa-edit"></i></a>
                <a href="#" class="ml-2 text-dark delete_btn" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{$doc->id}}"><i class="fa far fa-trash-alt"></i></a>
              </td>
              </tr>
              @endforeach
             
            </tbody>
          </table>     
    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="delete_modal modal-dialog modal-dialog-centered m-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-center align-items-center flex-column">
        <img src="{{asset('images/delete_pic.png')}}" class="delete_image">
        <p class="delete_text">Are you sure you want to delete?</p>
        <input type="hidden" name="delete_id" id="delete_id" value="">
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary no_btn" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary comon_color_btn yes_btn">Yes</button>
      </div>
    </div>
  </div>
</div>

       
  </div>


</div>

@endsection('content')
@section('javascript')
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(()=>{
      $(document).on("click", ".delete_btn", function() {
        var getId = $(this).attr('data-id');
        $('input#delete_id').val(getId);
      });
      $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
          $("#success-alert").slideUp(500);
      });
      // $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
      //     $("#success-alert").slideUp(500);
      // });
      $('#datatable_table').DataTable(
            {
            language: {
                searchPlaceholder: "Search Tables",
                search:''
            }
        });
        $(document).on('click', '.yes_btn', function() {
          $.LoadingOverlay("show");
          var getTableId = $('input#delete_id').val();
          $.ajax({
            type: "POST",
            url: "{{ route('DocumentDelete')}}",
            data: {
              'id': getTableId
            },
            success: function(result) {
              $.LoadingOverlay("hide");
              $('#DeleteModal').modal('hide');
              Swal.fire({
                type: 'success',
                title: 'Delete!',
                text: 'Document Delete successfully',
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
    });
   


</script>
@endsection('javascript')