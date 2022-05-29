<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script src="{{asset('fontawsome/baacebf324.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/jquery.timepicker.min.css')}}">
    <script src="{{asset('js/jquery.timepicker.min.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/toastr.min.css')}}">
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
    <script src="{{asset('js/select2.min.js')}}"></script>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>


   

    <!-- date picker -->
    
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <script src="{{asset('js/jquery-3.6.0.js')}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script>

    <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->


    <title>Voto Control</title>
  </head>
  <body style="background: #F5FCFF;">
   <div class="home_body">
      <!-- header nav start here  -->
      <div class="">
          <nav class="navbar navbar-expand-lg navbar-light">
              <img src="{{asset('images/Corche_Logo.png')}}">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              </button>
          
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto pl-5">
              @if(Auth::user()->role == 'Candidate')
                  <li class="nav-item  mx-2">
                      <a class="nav-link" href="{{route('home')}}">
                        <span class="{{ Route::currentRouteName() == 'home' ? 'active':''  }}" >Dashboard</span><span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item mx-2">
                      <a class="nav-link" href="{{route('StaffMember')}}">
                        <span class="{{Route::currentRoutename() == 'StaffMember' ? 'active' : ''}}">Staff </span>
                      </a>
                  </li>
                  @endif
                  @if(Auth::user()->role == 'Staff')
                  <li class="nav-item  mx-2">
                      <a class="nav-link" href="{{ route('home')}}">
                        <span class="{{ Route::currentRouteName() == 'home' ? 'active':''  }}">Documents</span><span class="sr-only">(current)</span></a>
                  </li>
                  
                  @endif
                  @if(Auth::user()->role == 'Admin')
                  <li class="nav-item  mx-2">
                            <a class="nav-link" href="{{ route('home')}}">
                                <span class="{{ Route::currentRouteName() == 'home' ? 'active':''  }} {{ Route::currentRouteName() == 'tables' ? 'active':''  }} {{ Route::currentRouteName() == 'candidateElection' ? 'active':''  }} {{ Route::currentRouteName() == 'PPElection' ? 'active':''  }}">Elections</span></a>
                  </li>
                  <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('systemCandidates')}}">
                                <span class="{{ Route::currentRouteName() == 'systemCandidates' ? 'active':''  }}">Candidates</span>
                            </a>
                  </li>
                  @endif
              </ul>
          
              <form class="form-inline my-2 my-lg-0 d-flex flex-row-reverse">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle profile_button" type="button" id="dropdownMenu2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="background-color: transparent;">
                                <img class="profile_avatar" @if(!empty(Auth::user()->candidate_img))
                                src="{{asset('avatars/'.Auth::user()->candidate_img.'')}}"
                                @endif @if(Auth::user()->candidate_img==null || empty(Auth::user()->candidate_img))
                                src="{{asset('images/tianiaPress.png')}}"
                                @endif >{{ Auth::user()->name }} 
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <a href="{{route('ProfileSetting')}}" class="dropdown-item" type="button"><i class="fa fa-cog" aria-hidden="true"></i> Setting</a>
                                <a class="dropdown-item" href="{{ route('logoutCustom') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</a>
                            </div>
                        </div>
                    </form>
              </div>
          </nav>
      </div>

      <!-- end here -->
      @yield('content')
         </div>
    <script src="{{asset('js/loadingoverlay.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/sweetalert2@11.js')}}"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.3.9/js/dataTables.autoFill.min.js"></script>
    <script src="{{asset('js/jquery.toaster.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script type="text/javascript">
       $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
      $( document ).ready(function() {
        $(document).on('click','.mark_as_complete',function(){
            $.LoadingOverlay("show");
            var ElectionId = $(this).attr('data-id');
            $.ajax({
                    type: "POST",
                    url: "{{ route('ElectionMarkComplete')}}",
                    cache: false,
                    data: {
                        ElectionId: ElectionId
                    },
                    success: function(result) {
                        $.LoadingOverlay("hide");
                        // $('#DeleteModal').modal('hide')
                        Swal.fire({
                            type: 'success',
                            title: 'Success !',
                            text: 'Election is Mark as Completed ✨',
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
        $(document).on('click','.mark_as_process',function(){
            $.LoadingOverlay("show");
            var ElectionId = $(this).attr('data-id');
            $.ajax({
                    type: "POST",
                    url: "{{ route('ElectionMarkProcess')}}",
                    cache: false,
                    data: {
                        ElectionId: ElectionId
                    },
                    success: function(result) {
                    $.LoadingOverlay("hide");
                        $('#DeleteModal').modal('hide')
                        Swal.fire({
                            type: 'success',
                            title: 'Success !',
                            text: 'Election is Mark as In Process ✨',
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
        $('.upload_btn').click(() => {
              $.LoadingOverlay("show");
              $('.main_content').addClass('d-none');
              setTimeout(function () {
                  $.LoadingOverlay("hide");
                  $('.down_content').removeClass('d-none');
              }, 2000);
              $("#start_date").datepicker();
              $( "#end_date" ).datepicker();
            });

        // $.LoadingOverlay("show");

        // setTimeout(function () {
        //     $.LoadingOverlay("hide");
        // }, 3000);
    });
    </script>
     @yield('javascript')
  </body>
  
</html>