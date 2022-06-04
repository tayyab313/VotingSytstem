@extends('layouts.main')

@section('content')

<!-- Main Content Here -->
<div class="main_content">
            <div class="container-fluid creat_election_div " style="margin-top: 40px;">
                <div class="heading_create_new_election">
                    <h2>Create new Election</h2>
                </div>
                <div class="form_div_election">
                    <div class="form_div w-100">
                        <form id="addElectionForm">
                            <div class="form-group">
                                <label for="name_of_election">Name of election</label>
                                <input type="text" class="form-control" id="name_of_election" name="name_of_election" placeholder="Enter Election Name">
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-3">
                                    <label for="start_date" >Start Date</label>
                                    <input type="text" class="form-control" id="start_date" name="start_date">

                                </div>
                                <div class="form-group col-3">
                                    <label for="start_time" >Start Time</label>
                                    <input type="time" class="form-control" id="start_time" name="start_time">

                                </div>
                                <div class="form-group col-3">
                                    <label for="end_date" >End Date</label>
                                    <input type="text" class="form-control" id="end_date" name="end_date">

                                </div>
                                <div class="form-group col-3">
                                    <label for="end_time" >End Time</label>
                                    <input type="time" class="form-control" id="end_time" name="end_time">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="Positions">Positions</label>
                                    <select id="Positions" name="Positions[]" class="form-control" multiple="">
                                        <option value="null" >Select</option>
                                        @foreach ($position as $pos)
                                        <option value="{{$pos['position_val']}}">{{$pos['position_val']}}</option>
                                            
                                        @endforeach
                                    </select>
                                    <a class="m-2 addOptionTab" style="color: blue;cursor:pointer" data-toggle="modal" data-target="#addOptionModal"><i class="fa-solid fa-plus"></i> Add New Position</a>
                                </div>
                            </div>
                            <button type="button" class="btn  float-right comon_color_btn crate_election_btn">Create Election<i
                                    class="ml-2 fa fa-arrow-right" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<!-- add opption modal -->
<div class="modal fade" id="addOptionModal" tabindex="-1" role="dialog" aria-labelledby="addOptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addOptionModalLabel">Position Name</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="text" class="form-control position_input">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary addPositionbtn">Add Position</button>
        </div>
        </div>
    </div>
    </div>
    </div>



@endsection('content')

@section('javascript')
<script>
     $(document).ready(function () {
                $.LoadingOverlay("show");
                // $('.create_tab_div').addClass('d-none');
                setTimeout(function () {
                    $.LoadingOverlay("hide");
                }, 1000);
                
                    $( "#start_date" ).datepicker();
                    $( "#end_date" ).datepicker();
            $('.crate_election_btn').click((e)=>{
                    e.preventDefault();
                    $.LoadingOverlay("show");
                    var form = $('#addElectionForm')[0];
                    var formdata = new FormData(form);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('creatElection')}}",
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: formdata,
                        enctype: 'multipart/form-data',
                        success: function(result){
                            $.LoadingOverlay("hide");
                                if(result.errors)
                                {
                                    $.toaster({ priority :'danger', title :'Wrong', message :'All Fields Required'});
                                }
                                else
                                {
                                    Swal.fire({
                                    type: 'success',
                                    title: 'Success!',
                                    text: 'Election created successfully  🔥',
                                    showConfirmButton: false,
                                    timer: 4000
                                    })
                                    setTimeout(() => {
                                        location.href = "{{route('home')}}";
                                    }, 2000);
                                }
                        },
                            error: function(){
                                alert("Error");
                            }
                    });
            });
            $('.addPositionbtn').click(()=>{
                $.LoadingOverlay("hide");
                var get_valu_position = $('.position_input').val();
                $('#Positions').append(`<option value="`+get_valu_position+`">`+get_valu_position+`</option>`);
                $.ajax({
                        type: "POST",
                        url: "{{ route('addPosition')}}",
                        data: {'value':get_valu_position},
                        success: function(result){
                            $.LoadingOverlay("hide");
                            $('#addOptionModal').modal('hide');
                                    Swal.fire({
                                    type: 'success',
                                    title: 'Success!',
                                    text: 'Position added successfully  🔥',
                                    showConfirmButton: false,
                                    timer: 4000
                                    })
                                    setTimeout(() => {
                                        location.reload();
                                    }, 2000);
                                
                        },
                            error: function(){
                                alert("Error");
                            }
                    });
            });
            
            });
</script>
@endsection('javascript')
