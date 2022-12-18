<!DOCTYPE html>
<!-- beautify ignore:start -->
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
  data-assets-path="{{url('/assets/')}}" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>Neno Laser Clinic</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{url('/assets/img/favicon/favicon.png')}}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{url('/assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{url('/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{url('/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{url('/assets/css/demo.css')}}" />
    <link rel="stylesheet" href="{{url('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{url('/assets/vendor/css/pages/page-auth.css')}}" />
    <script src="{{url('/assets/vendor/js/helpers.js')}}"></script>
    <script src="{{url('/assets/js/config.js')}}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">

                  <span class="app-brand-logo demo">
                        <img src="{{url('/assets/img/favicon/logo.png')}}">
                  </span>
                  {{-- <span class="app-brand-text demo text-body fw-bolder">MAS Group</span> --}}
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to Neno Laser Clinic 👋</h4>
              <p class="mb-4">Please sign-in to your account</p>

              <form id="formAuthentication" class="mb-3" action="{{ url('/') }}" method="POST">

                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}} </div>
                @endif
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email or Username</label>
                    <input type="text" class="form-control" id="username" name="username" value ="{{old('username')}}"
                    placeholder="Enter your email or username" autofocus />
                    <span>
                        @error('username')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="auth-forgot-password-basic.html">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        <span>
                            @error('password')
                                {{$message}}
                            @enderror
                        </span>
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>

              <p class="text-center">
                <span>Designed & Developerd By GenX Technology</span>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{url('/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{url('/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{url('/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{url('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{url('/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{url('/assets/js/main.js')}}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
