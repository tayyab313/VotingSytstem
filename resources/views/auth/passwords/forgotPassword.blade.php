<!doctype html>
<html lang="en">
  <head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" href="css/style.css">
   <script src="https://kit.fontawesome.com/baacebf324.js" crossorigin="anonymous"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <title>Forgot Password</title>
  </head>
  <body>
    <div class="w-100 float-left ">

    <div class="row no-gutters">

        <div class="col-lg-6 col-md-6 col-sm-12 no-gutters">
            <div class="leftside">
                <div class="form-div left_div_style">
                <form action="{{ route('forget.password.post') }}" method="POST">
                          @csrf
                        <div class="form-row d-flex justify-content-center">
                            <div class="form-group col-8">
                                <h2  class="text_comon">Forgot Password?</h2>
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                
                                <a class="heading_color">No worries! Enter your email address and you'll receive a link to reset your password</a>
                            </div>
                        </div>
                        <div class="form-row d-flex justify-content-center">
                            <div class="form-group col-8">
                                <label for="email" class="text_comon">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email">
                                @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                            </div>
                        </div>
                        <div class="form-row d-flex justify-content-center">
                            <div class="form-group col-8">
                                <button type="submit" class="btn btn-primary btn-block" >Send Password Reset Link</button>
                            </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 no-gutters rightsideMainDIv">
            <div class="rightside">
                <img class="main_image "src="images/reset-ForgotPass.png">
            </div>
        </div>
    </div>
    </div>




     
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>