@extends('layouts.main')

@section('content')

<div class="main_content mt-5">
            <div class="breadCrumbs">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li>Settings</li>
                </ul>
            </div>
            <div class="document_heading container-fluid d-flex justify-content-between">
                <p class="document_paragraph">Settings</p>
            </div>
        </div>
    <form id='UserProfileform'>

            <div class="container-fluid creat_election_div">


                <div class="profile_div">
                    <h3>Position details</h3>

                    <div class="form_div w-100">

                        <div class="form-row">
                        <div id="staff_img" class="form-group  political_party_logo">
                            <img src="{{asset('images/can_camera.png')}}" class="can_cam_image">
                            <img id="preview_pol_party" @if(!empty(session()->get('LoginUserImage')))src=" {{env('LINK')}}avatars/{{ session()->get('LoginUserImage') }} "@endif" style="width: 78px;height: 83px;border-radius: 8px;position: relative;top: 3px;right: 0px;">
                            <p class="candidate_p_style">Staff Picture</p>
                            <input type="file" class="form-control d-none" id="user_pic" name="user_pic" oninput="preview_pol_party.src=window.URL.createObjectURL(this.files[0])">

                        </div> 
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter" value="{{Auth::user()->name}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter" value="{{Auth::user()->email}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="password_profile_div mt-2">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <h3>Change Password</h3>
                        <!-- <p class="total_votes_count">Total Votes: 00</p> -->
                    </div>


                    <div class="form_div w-100">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="old_password">Old Password</label>
                                <input type="password" class="form-control" id="old_password" name="old_password"
                                    placeholder="Enter">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    placeholder="Enter">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="c_password">Confirm New Password</label>
                                <input type="password" class="form-control" id="c_password" name="c_password"
                                    placeholder="Enter">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- footer -->
        <footer>
            <div class="footer d-flex justify-content-end">
                <button class="btn footer_cancel_btn">Cancel</button>
                <button class="btn footer_update_btn UpdateProfile_btn" data-id="{{Auth::user()->id}}">Update Profile<i class="ml-2 fa fa-arrow-right"
                        aria-hidden="true"></i></button>
            </div>
        </footer>
    </form>
@endsection('content')

@section('javascript')
<script type="text/javascript">
    $(document).ready(()=>{
        $("#staff_img").click(function() {
            $("#user_pic")[0].click();
        });
        $('.UpdateProfile_btn').click((e)=>{
            e.preventDefault();
            var get_id = $('.UpdateProfile_btn').attr('data-id');
                var form = $('#UserProfileform')[0];
                var formdata = new FormData(form);
                formdata.append('id',get_id);
                $.LoadingOverlay("show");
                $.ajax({
                        type: "POST",
                        url: "{{ route('UpdateUserProfile')}}",
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: formdata,
                        enctype: 'multipart/form-data',
                        success: function(result) {
                            $.LoadingOverlay("hide");
                            if (result.errors) {
                                $.toaster({ priority :'danger', title :'Wrong', message :result.errors});
                            } else {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Success!',
                                    text: 'Staff Member Profile Updated🔥',
                                    showConfirmButton: false,
                                    timer: 4000
                                })
                                setTimeout(() => {
                                    location.reload();
                                }, 2000);
                            }
                        },
                        error: function(){
                            alert("Error");
                        }
                    });
        });
    });


</script>
@endsection('javascript')