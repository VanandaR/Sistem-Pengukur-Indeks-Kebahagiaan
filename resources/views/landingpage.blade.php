<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="/assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/assets/img/favicon-32x32.png" sizes="32x32">

    <title>Altair Admin Landing Page</title>

    <!-- uikit -->
    <link rel="stylesheet" href="/bower_components/uikit/css/uikit.almost-flat.min.css" media="all">

    <!-- altair landing page -->
    <link rel="stylesheet" href="/assets/css/landingpage.css" media="all">

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
    <script type="text/javascript" src="/bower_components/matchMedia/matchMedia.js"></script>
    <script type="text/javascript" src="/bower_components/matchMedia/matchMedia.addListener.js"></script>
    <![endif]-->
</head>
<body style="background-color:#ececec">
<!-- navigation -->
<header id="header_main">
    <nav class="uk-navbar">
        <div class="uk-container uk-container-center">
            <a href="#" class="uk-float-left" id="mobile_navigation_toggle" data-uk-offcanvas="{target:'#mobile_navigation'}"><i class="material-icons">&#xE5D2;</i></a>
            <a href="/" class="uk-navbar-brand">
                <img src="assets/img/logo_main.png" alt="" width="71" height="15">
            </a>
            <a href="/login" class="md-btn md-btn-primary uk-navbar-flip header_cta uk-margin-left">Login</a>
            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav" id="main_navigation">
                    <li>
                        <a href="#sect-overview">
                            About
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>


<section class="banner" id="sect-overview">

    <div >
        <div class="uk-container uk-container-center">
            <div class="slide_content_a">
                <div style="text-align:center;padding-top: 40px">
                <h1>Indeks Kebahagiaan hari ini</h1>
                    <h1 style="font-size:100px;margin:100px 0px 100px 0px">60.52</h1>
                    <img src="/assets/img/people.png" class="left-section" style="max-width:100%;">
                </div>
                    <p>

                </p>

            </div>
        </div>
    </div>
</section>

<!-- common functions -->
<script src="assets/js/common.min.js"></script>
<!-- uikit functions -->
<script src="assets/js/uikit_custom.min.js"></script>
<!-- altair common functions/helpers -->
<script src="assets/js/altair_lp_common.js"></script>
</body>