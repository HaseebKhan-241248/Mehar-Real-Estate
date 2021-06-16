<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/logo-fav.png">
    <title>Beagle</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/material-design-icons/css/material-design-iconic-font.min.css') }}"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css"/>
      <style type="text/css">
          .splash-container {
              margin-top: auto !important;
          }
      </style>
  </head>
  <body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading">
                  <img src="{{ asset('assets/img/a.png') }}" alt="logo" width="130" height="120" class="logo-img">
                  <span class="splash-description">Please enter your user information.</span></div>
              <div class="panel-body">
                  <form method="POST" action="{{ route('login') }}">
                      @csrf
                  <div class="form-group">

                      <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="password" class=" col-form-label text-md-right">{{ __('Password') }}</label>
                    <input id="password" placeholder="*******" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                  </div>
                  <div class="form-group row login-tools">
                    <div class="col-xs-6 login-remember">
                      <div class="be-checkbox">
                          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                          <label class="form-check-label" for="remember">
                              {{ __('Remember Me') }}
                          </label>
                      </div>
                    </div>
{{--                    <div class="col-xs-6 login-forgot-password"><a href="#">Forgot Password?</a></div>--}}
                  </div>
                  <div class="form-group login-submit">
                      <button type="submit" class="btn btn-primary">
                          {{ __('Login') }}
                      </button>

{{--                      @if (Route::has('password.request'))--}}
{{--                          <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                              {{ __('Forgot Your Password?') }}--}}
{{--                          </a>--}}
{{--                      @endif--}}
                  </div>
                </form>
              </div>
            </div>
{{--            <div class="splash-footer"><span>Don't have an account? <a href="#">Sign Up</a></span></div>--}}
          </div>
        </div>
      </div>
    </div>
    <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      });

    </script>
  </body>
</html>
