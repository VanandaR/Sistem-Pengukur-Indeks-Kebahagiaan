<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">

    <title>vanandarahadika.com - register</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="/bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="/assets/css/login_page.min.css" />

</head>
<body class="login_page">

<div class="login_page_wrapper">
    <div class="md-card" id="login_card">
        <div class="md-card-content large-padding" id="register_form">
            <h2 class="heading_a uk-margin-medium-bottom">Buat Akun</h2>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="uk-form-row{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="register_email">E-mail</label>
                    <input id="email" type="email" class="md-input {{$errors->has('email') ? 'md-input-danger' : '' }}" name="email" value="{{ $email or old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block wrong_reason">
                                        {{ $errors->first('email') }}
                                    </span>
                    @endif
                </div>

                <div class="uk-form-row{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="register_password">Password</label>
                    <input id="password" type="password" class="md-input {{$errors->has('password') ? 'md-input-danger' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block wrong_reason">{{ $errors->first('password') }}
                                    </span>
                    @endif
                </div>

                <div class="uk-form-row">
                    <label for="register_password_repeat">Konfirmasi Password</label>
                    <input id="password-confirm" type="password" class="md-input" name="password_confirmation" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block wrong_reason">{{ $errors->first('password_confirmation') }}
                                    </span>
                    @endif
                </div>

                <div class="uk-margin-medium-top">
                    <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
    <div class="uk-margin-top uk-text-center">
        Sudah punya akun? Silahkan <a href="/login">login</a>
    </div>
</div>
<style>
    .wrong_reason{
        margin-top:0px;
        font-size: 12px;
        position: absolute;
        color: #e53935;
        transition: opacity .2s ease-in;
    }
</style>
<!-- common functions -->
<script src="/assets/js/common.min.js"></script>
<!-- altair core functions -->
<script src="/assets/js/altair_admin_common.min.js"></script>

<!-- altair login page functions -->
<script src="/assets/js/pages/login.min.js"></script>

</body>
</html>