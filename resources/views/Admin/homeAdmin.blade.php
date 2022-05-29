@extends('layouts.main')

@section('content')

<!-- Main Content Here -->
<div class="main_content">
            <div class="breadCrumbs create_tab_div">
                <p class="breadCrumbs_heading">Elections</p>
            </div>
            <div class="container-fluid create_tab_div ">
                <!-- <div class="row" style="display: flex;flex-direction: row;justify-content: space-around;"> -->
                <div class="row comon_div_election_style" >
                    <a href="{{route('crateElection')}}" class="create_election mt-1 ml-2">
                        <div class="create_Election d-flex align-items-center">
                            <img src="images/create_election.png" class="m-2" style="width: 68px;height: 68px;">
                            <p class="craete_text">Create New Election</p>
                        </div>
                    </a>
                    @foreach ($Election as $elections)
                    <a href="{{route('tables',$elections['id'])}}" class="election_link">
                        <div class="common_div_style d-flex ml-2 mt-1">
                            <div class="d-flex     align-items-center">
                                <img class="vote_img" src="images/Vote.png"
                                    style="width: 81px;height:81px;position:relative;left: 20px;margin: 10px 0;">
                                <div class="d-flex flex-column" style="margin-left: 3rem!important;">
                                    <p class="first_text" style="margin-bottom:0;">{{$elections['election_name']}}</p>
                                    <p style="margin-bottom:0;"><i class="fa fad fa-calendar-alt mr-1"></i>{{$elections['start_date']}}</p>
                                    <p class="{{$elections['status'] =='completed'? 'complete_btn' : 'in_porcess_btn' }}">{{$elections['status']}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                        
                    @endforeach


                    <!-- <div class="common_div_style d-flex election_third_div">
                        <div class="d-flex     align-items-center">
                            <img class="vote_img" src="images/Vote.png"
                                style="width: 81px;height:81px;position:relative;left: 20px;">
                            <div class="d-flex flex-column" style="margin-left: 3rem!important;">
                                <p class="first_text" style="margin-bottom:0;">Election 2022</p>
                                <p style="margin-bottom:0;"><i class="fa fad fa-calendar-alt"></i>12/04/2022</p>
                                <p style="margin-bottom:0;color: #19AA86;">Completed</p>
                            </div>
                        </div>
                    </div>

                    <div class="common_div_style d-flex election_fourth_div">
                        <div class="d-flex     align-items-center">
                            <img class="vote_img" src="images/Vote.png"
                                style="width: 81px;height:81px;position:relative;left: 20px;">
                            <div class="d-flex flex-column" style="margin-left: 3rem!important;">
                                <p class="first_text" style="margin-bottom:0;">Election 2022</p>
                                <p style="margin-bottom:0;"><i class="fa fad fa-calendar-alt"></i>12/04/2022</p>
                                <p style="margin-bottom:0;color: #19AA86;">Completed</p>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            
        </div>


    </div>



@endsection('content')

@section('javascript')
<script>
     $(document).ready(function () {
            $.LoadingOverlay("show");
                setTimeout(function () {
                    $.LoadingOverlay("hide");
                }, 2000);
            // $('.crate_election_btn').click((e)=>{
            //         e.preventDefault();
            //         $.LoadingOverlay("show");
            //         var form = $('#addElectionForm')[0];
            //         var formdata = new FormData(form);
            //         $.ajax({
            //             type: "POST",
            //             url: "{{ route('creatElection')}}",
            //             processData: false,
            //             contentType: false,
            //             cache: false,
            //             data: formdata,
            //             enctype: 'multipart/form-data',
            //             success: function(result){
            //                 $.LoadingOverlay("hide");
            //                     if(result.errors)
            //                     {
            //                         $.toaster({ priority :'danger', title :'Wrong', message :'All Fields Required'});
            //                     }
            //                     else
            //                     {
            //                         Swal.fire({
            //                         type: 'success',
            //                         title: 'Success!',
            //                         text: 'Election created successfully  🔥',
            //                         showConfirmButton: false,
            //                         timer: 4000
            //                         })
            //                         setTimeout(() => {
            //                             location.reload();
            //                         }, 2000);
            //                     }
            //             },
            //                 error: function(){
            //                     alert("Error");
            //                 }
            //         });
            // });
            // $('.addPositionbtn').click(()=>{
            //     $.LoadingOverlay("hide");
            //     var get_valu_position = $('.position_input').val();
            //     $('#Positions').append(`<option value="`+get_valu_position+`">`+get_valu_position+`</option>`);
            //     $.ajax({
            //             type: "POST",
            //             url: "{{ route('addPosition')}}",
            //             data: {'value':get_valu_position},
            //             success: function(result){
            //                 $.LoadingOverlay("hide");
            //                 $('#addOptionModal').modal('hide');
            //                         Swal.fire({
            //                         type: 'success',
            //                         title: 'Success!',
            //                         text: 'Position added successfully  🔥',
            //                         showConfirmButton: false,
            //                         timer: 4000
            //                         })
            //                         setTimeout(() => {
            //                             location.reload();
            //                         }, 2000);
                                
            //             },
            //                 error: function(){
            //                     alert("Error");
            //                 }
            //         });
            // });
            
            });
</script>
@endsection('javascript')
