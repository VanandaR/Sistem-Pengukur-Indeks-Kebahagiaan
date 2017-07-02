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

    <title>vanandarahadika.com - login</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="/bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="/assets/css/login_page.min.css" />

</head>
<body class="login_page">

    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <div class="user_avatar"></div>
                </div>
                <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="uk-form-row <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                        <label for="login_email">Email</label>
                        <input id="login_email" type="email" class="md-input <?php echo e($errors->has('email') ? 'md-input-danger' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                        <?php if($errors->has('email')): ?>
                            <span class="help-block wrong_reason"><?php echo e($errors->first('email')); ?>

                                    </span>
                        <?php endif; ?>
                    </div>
                    <div class="uk-form-row <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">

                        <label for="login_password">Password</label>
                        <input id="login_password" type="password" class="md-input <?php echo e($errors->has('password') ? 'md-input-danger' : ''); ?>" name="password" required>
                        <?php if($errors->has('password')): ?>
                            <span class="help-block wrong_reason"><?php echo e($errors->first('password')); ?>

                                    </span>
                        <?php endif; ?>
                    </div>
                    <div class="uk-margin-medium-top">
                        <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Sign In</button>
                    </div>
                    <div class="uk-margin-top">
                        <a href="#" id="login_help_show" class="uk-float-right">Need help?</a>
                        <span class="icheck-inline">
                            <input type="checkbox" name="login_page_stay_signed" id="login_page_stay_signed" data-md-icheck />
                            <label for="login_page_stay_signed" class="inline-label">Stay signed in</label>
                        </span>
                    </div>
                </form>
            </div>
            <div class="md-card-content large-padding uk-position-relative" id="login_help" style="display: none">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                <h2 class="heading_b uk-text-success">Can't log in?</h2>
                <p>Here’s the info to get you back in to your account as quickly as possible.</p>
                <p>First, try the easiest thing: if you remember your password but it isn’t working, make sure that Caps Lock is turned off, and that your username is spelled correctly, and then try again.</p>
                <p>If your password still isn’t working, it’s time to <a href="#" id="password_reset_show">reset your password</a>.</p>
            </div>
            <div class="md-card-content large-padding" id="login_password_reset" style="display: none">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                <h2 class="heading_a uk-margin-large-bottom">Reset password</h2>
                <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>
                <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('password.email')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="uk-form-row">
                        <label for="login_email_reset">Your email address</label>
                        <input id="email" type="email" class="form-control md-input" name="email" value="<?php echo e(old('email')); ?>" required>

                        <?php if($errors->has('email')): ?>
                            <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                        <?php endif; ?>
                    </div>
                    <div class="uk-margin-medium-top">
                        <button type="submit" class="md-btn md-btn-primary md-btn-block">Reset password</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="uk-margin-top uk-text-center">
            <a href="/register">Buat akun</a>
        </div>
    </div>
    <style>
        .wrong_reason{
            margin-top: 0px;
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