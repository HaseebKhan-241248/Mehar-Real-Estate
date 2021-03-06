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
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
</head>
<body class="be-splash-screen">
<div class="be-wrapper be-login be-signup">
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="splash-container sign-up">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading"><img src="assets/img/logo-xx.png" alt="logo" width="102" height="27" class="logo-img"><span class="splash-description">Please enter your user information.</span></div>
                    <div class="panel-body">
                        <form action="index.html" method="get"><span class="splash-title xs-pb-20">Sign Up</span>
                            <div class="form-group">
                                <input type="text" name="nick" required="" placeholder="Username" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" required="" placeholder="E-mail" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group row signup-password">
                                <div class="col-xs-6">
                                    <input id="pass1" type="password" required="" class="form-control">
                                </div>
                                <div class="col-xs-6">
                                    <input required="" placeholder="Confirm" class="form-control">
                                </div>
                            </div>
                            <div class="form-group xs-pt-10">
                                <button type="submit" class="btn btn-block btn-primary btn-xl">Sign Up</button>
                            </div>
                            <div class="title"><span class="splash-title xs-pb-15">Or</span></div>
                            <div class="form-group row social-signup">
                                <div class="col-xs-6">
                                    <button type="button" class="btn btn-lg btn-block btn-social btn-facebook btn-color"><i class="mdi mdi-facebook icon icon-left"></i> Facebook</button>
                                </div>
                                <div class="col-xs-6">
                                    <button type="button" class="btn btn-lg btn-block btn-social btn-google-plus btn-color"><i class="mdi mdi-google-plus icon icon-left"></i> Google Plus</button>
                                </div>
                            </div>
                            <div class="form-group xs-pt-10">
                                <div class="be-checkbox">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">By creating an account, you agree the <a href="#">terms and conditions</a>.</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="splash-footer">&copy; 2016 Your Company</div>
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
