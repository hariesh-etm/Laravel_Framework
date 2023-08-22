<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>404 Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="404 page not found" name="description" />
    <meta content="Pichforest" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('assets/images/favicon.ico')}}">
    <!-- Bootstrap Css -->
    <link href="{{url('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{url('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{url('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
  </head>
  <body>
  <!-- <body data-layout="horizontal"> -->
    <div class="authentication-bg min-vh-100">
      <div class="bg-overlay bg-white"></div>
      <div class="container">
        <div class="d-flex flex-column min-vh-100 px-3 pt-4">
          <div class="row justify-content-center my-auto">
            <div class="col-lg-10">
              <div class="py-5">
                <div class="card auth-cover-card overflow-hidden">
                  <div class="row g-0">
                    <div class="col-lg-6">
                      <div class="auth-img"></div>                                            
                    </div><!-- end col -->
                    <div class="col-lg-6">
                      <div class="p-4 p-lg-5 bg-primary h-100 d-flex align-items-center justify-content-center">
                        <div class="w-100 text-center">
                          <h1 class="display-1 fw-normal error-text text-white">4<img src="{{url('assets/images/logo-sm-light.png')}}" alt=""
                              class="avatar-lg h-auto mx-2">4</h1>
                          <h4 class="text-uppercase text-white-50">Opps, page not found</h4>
                          <div class="mt-5 text-center">
                            <a class="btn btn-info w-100" href="{{url('admin')}}">Back to Dashboard</a>
                          </div>
                        </div>
                      </div>
                    </div><!-- end col -->
                  </div><!-- end row -->
                </div><!-- end card -->
              </div>
            </div><!-- end col -->
          </div><!-- end row -->
        </div>
      </div>
      <!-- end container -->
    </div>
    <!-- end authentication section -->
    <!-- JAVASCRIPT -->
    <script src="{{url('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('assets/libs/metismenujs/metismenujs.min.js')}}"></script>
    <script src="{{url('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{url('assets/libs/feather-icons/feather.min.js')}}"></script>
  </body>
</html>