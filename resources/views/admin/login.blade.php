<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{url('assets/css/login.css')}}">
        <link rel="stylesheet" href="{{url('assets/fontawesome/css/all.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&family=Roboto:wght@400;500;700&display=swap"
            rel="stylesheet">
            <script type="text/javascript">
                var base_url='<?=url('/')?>';
              </script>
            <script src="{{url('assets/js/jquery/jquery-3.6.1.min.js')}}"></script>
            <script src="{{url('assets/js/jquery/jquery.validate.min.js')}}"></script>
            <script src="{{url('assets/js/jquery/additional-methods.min.js')}}"></script>
            <script src="{{url('assets/js/jquery/jquery.form.min.js')}}"></script>
            <script src="{{url('assets/js/jquery/common.util.js')}}"></script>

            <script src="https://accounts.google.com/gsi/client" async defer></script>


        <title>Login</title>
        <style>

        </style>

    </head>

    <body>
        <div class="login-wrap">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6 col-md-12">
                        <img src="assets/images/login-img.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="form-wrap">
                            <div class="title text-center">
                                <h2><b>Keep Connected</b></h2>
                                <p>Login with your credential to<br> access your account</p>
                            </div>
                           
                            <form method="post" action="{{url('api/v1/login')}}" class="ajaxForm" error.message="inline">
                                @csrf
                                <div class="login-form">
                                    <div class="bg-color">
                    <div class="form-floating form-floating-custom mb-3">
                      <input type="text" class="form-control" id="input-username" placeholder="Enter User name" name="username">
                      <label for="input-username">Username</label>
                      <div class="form-floating-icon">
                        <i class="uil uil-users-alt"></i>
                      </div>
                    </div>
                    <div class="form-floating form-floating-custom mb-3">
                      <input type="password" class="form-control" id="input-password" placeholder="Enter Password" name="password">
                      <label for="input-password">Password</label>
                      <div class="form-floating-icon">
                        <i class="uil uil-padlock"></i>
                      </div>
                    </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>

                            </div></div>
                                <div class="text-center mt-4" >
                                    <button class="btn login" type="submit">Login</button>
                                    <br>
                                    <div id="g_id_onload"
                                    data-client_id="764067860116-m1j6r9fmii6g3kgpo9dcvb6ejmernkt8.apps.googleusercontent.com"
                                    data-callback="handleCredentialResponse">
                               </div>
                               <div class="g_id_signin pt-3" data-type="standard" style="text-align: -webkit-center;"></div>
                                </div>
                            </form>
                               
                             {{-- <form method="post" action="{{url('api/v1/login')}}" class="ajaxForm" error.message="inline">
                                @csrf
                            <div class="login-form">
                                <div class="bg-color">
                                    <div class="form-floating form-floating-custom mb-3">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="username" name="username">
                                      </div>
                                    </div>
                                      <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="d-flex align-items-center" style="position: relative;">
                                            <input type="password" class="form-control" id="password" name="password">
                                            <div class="password-icon d-flex" style="position: absolute; right: 0px">
                                                <i class="fa-regular fa-eye px-2" style="display: none;"></i>
                                                <i class="fa-regular fa-eye-slash px-2"></i>
                                            </div>
                                        </div>
                                        <span class="mt-3 text-end" style="display: block;"><a href="#">Forget Password ?</a></span>
                                      </div>
                                </div>
                                  <div class="text-center mt-4">
                                    <a href="#" class="btn login" type="submit">Login</a>
                                  </form> --}}
                                  <div class="text mb-3 mt-3">
                                    Are you not a member of our club ?
                                  </div>
                                  <a href="#" class="btn">Create Account</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://unpkg.com/jwt-decode/build/jwt-decode.js"></script>
    <script>

function handleCredentialResponse(response) {
    const responsePayload = jwt_decode(response.credential);

console.log("ID: " + responsePayload.sub);
console.log('Full Name: ' + responsePayload.name);
console.log('Given Name: ' + responsePayload.given_name);
console.log('Family Name: ' + responsePayload.family_name);
console.log("Image URL: " + responsePayload.picture);
console.log("Email: " + responsePayload.email);

        $.ajax({
                type: 'POST',
                url: '<?php echo url('/'); ?>/api/v1/googlelogin',
                data: {
                    'username': responsePayload.email,
                    'password': responsePayload.sub
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == "SUCCESS") {
                        window.location.href = "<?=url('/')?>";
                        //location.reload();
                    } else {
                        $("#error").show();
                        $("#errormessage").text(data.message);
                    }

                }
            });


}

        const eye = document.querySelector(".fa-eye");
const eyeoff = document.querySelector(".fa-eye-slash");
const passwordField = document.querySelector("input[type=password]");

eyeoff.addEventListener("click", () => {
  eye.style.display = "block";
  eyeoff.style.display = "none";

  passwordField.type = "text";
});

eye.addEventListener("click", () => {
  eyeoff.style.display = "block";
  eye.style.display = "none";

  passwordField.type = "password";
});

$(document).on("click", ".login", function (e) {
    var username = $("#username").val();
        var password = $("#password").val();

        if (username != "" && password != "") {
            $.ajax({
                type: 'POST',
                url: '<?php echo url('/'); ?>/api/v1/login',
                data: {
                    'username': username,
                    'password': password
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == "SUCCESS") {
                        window.location.href = "<?=url('/')?>";
                        //location.reload();
                    } else {
                        $("#error").show();
                        $("#errormessage").text(data.message);
                    }

                }
            });
        } else {
            Swal.fire(
                'Failed!',
                'Please Fill the (*) Fields',
                'error'
            );

        }
});

    </script>

</html>
