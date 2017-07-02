<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="/assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/assets/img/favicon-32x32.png" sizes="32x32">

    <title>vanandarahadika.com - home</title>

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
<body>
<!-- navigation -->
<style>
    #header_main .uk-navbar-nav > li.current_active a{
        box-shadow: inset 0 -4px 0 #2196f3;
    }

</style>
<header id="header_main">
    <nav class="uk-navbar">
        <div class="uk-container uk-container-center">
            <a href="#" class="uk-float-left" id="mobile_navigation_toggle" data-uk-offcanvas="{target:'#mobile_navigation'}"><i class="material-icons">&#xE5D2;</i></a>
            <a href="/" class="uk-navbar-brand">
                <img src="/assets/img/vanrah.png" alt="" width="150" height="30">
            </a>
            <a href="/login" class="md-btn md-btn-primary uk-navbar-flip header_cta uk-margin-left">Login</a>
            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav" id="main_navigation">
                    <li>
                        <a href="#sect-overview">
                            Overview
                        </a>
                    </li>
                    <li>
                        <a href="#sect-features">
                            Kelebihan
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div id="mobile_navigation" class="uk-offcanvas">
    <div class="uk-offcanvas-bar">
        <ul>
            <li>
                <a href="#sect-overview" data-uk-smooth-scroll="{offset: 48}">
                    <span class="menu_icon"><i class="material-icons">&#xE417;</i></span>
                    <span class="menu_title">Overview</span>
                </a>
            </li>
            <li>
                <a href="#sect-features" data-uk-smooth-scroll="{offset: 48}">
                    <span class="menu_icon"><i class="material-icons">&#xE896;</i></span>
                    <span class="menu_title">Kelebihan</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<section class="banner" id="sect-overview">
    <div data-uk-slideshow="{animation: 'swipe'}" data-uk-parallax="{yp: '25', velocity: '0.4'}">
        <ul class="uk-slideshow">
            <li style="background-image: url('/assets/img/landingpage/stats.jpg')">
                <div class="uk-container uk-container-center">
                    <div class="slide_content_c">
                        <h2 class="slide_header">Selamat Datang di vanandarahadika.com</h2>
                        <p>
                            Ini adalah website tugas akhir saya yang mampu memberikan informasi indeks kebahagiaan secara cepat menggunakan sentimen analisis media sosial. Bantu saya untuk memperbaiki sistem ini dengan mendaftar menjadi ahli bahasa.
                        </p>
                        <a href="/register" class="md-btn md-btn-large md-btn-danger">Daftar sebagai ahli bahasa</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>
<section class="section section_large" id="sect-features">
    <div class="uk-container uk-container-center">
        <div class="uk-grid">
            <div class="uk-width-large-3-5 uk-container-center uk-text-center">
                <h2 class="heading_b">
                    Kelebihan Sistem
                    <span class="sub-heading">Statistik Indeks Kebahagiaan</span>
                </h2>
            </div>
        </div>
        <div class="uk-grid uk-grid-width-1-1 uk-grid-width-medium-1-3 uk-grid-width-large-1-3 animate" data-uk-scrollspy="{cls:'uk-animation-slide-bottom animated',target:'> *',delay:300,topoffset:-100}">
            <div class="uk-margin-top">
                <div class="uk-text-center uk-margin-bottom">
                    <i class="material-icons icon_large icon_dark">&#xE85C;</i>
                </div>
                <h3 class="heading_c uk-text-center">Statistik</h3>
                <p class="uk-text-center">Menampilkan Statistik Indeks Kebahagiaan yang dapat dengan mudah dibaca</p>
            </div>
            <div class="uk-margin-top">
                <div class="uk-text-center uk-margin-bottom">
                    <i class="material-icons icon_large icon_dark">&#xE8DC;</i>
                </div>
                <h3 class="heading_c uk-text-center">Teruji</h3>
                <p class="uk-text-center">Menggunakan metodologi data mining, yang memiliki akurasi cukup tinggi</p>
            </div>
            <div class="uk-margin-top">
                <div class="uk-text-center uk-margin-bottom">
                    <i class="material-icons icon_large icon_dark md-color-red-500">&#xE3AF;</i>
                </div>
                <h3 class="heading_c uk-text-center">Tepat</h3>
                <p class="uk-text-center">Berbasis sentimen analisis di media sosial</p>
            </div>
        </div>
    </div>
</section>
<section class="section section_dark md-bg-blue-grey-700">
    <div class="uk-container uk-container-center">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-3-5 uk-text-center-medium">
                Copyright &copy; Vananda Rahadika
            </div>
            <div class="uk-width-medium-2-5">
                <div class="uk-align-medium-right uk-text-center-medium">
                    <a href="#" class="uk-margin-medium-right" data-uk-tooltip="{offset: 12}" title="Facebook"><i class="uk-icon-facebook uk-icon-small md-color-white"></i></a><!--
                        --><a href="#" class="uk-margin-medium-right" data-uk-tooltip="{offset: 12}" title="Twitter"><i class="uk-icon-twitter uk-icon-small md-color-white"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- google web fonts -->
<script>
    WebFontConfig = {
        google: {
            families: [
                'Source+Code+Pro:400,700:latin',
                'Roboto:300,400,500,700,400italic:latin'
            ]
        }
    };
    (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();
</script>

<!-- common functions -->
<script src="/assets/js/common_lp.min.js"></script>
<!-- uikit functions -->
<script src="/assets/js/uikit_custom_lp.min.js"></script>
<!-- altair common functions/helpers -->
<script src="/assets/js/altair_lp_common.js"></script>

<script>
    $(function() {
        if(isHighDensity()) {
            $.getScript( "/assets/js/custom/dense.min.js", function(data) {
                // enable hires images
                if (typeof $.fn.dense !== "undefined") {
                    $('img')
                    // set resolution cap at "2"
                            .attr('data-dense-cap',2)
                            .dense({
                                glue: "@",
                                ping: false
                            });
                }
            });
        }
    });
</script>

<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "cfs.uzone.id/2fn7a2/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582CL4NjpNgssKO%2bI3UxfpuPpZj7oeRqgkX65ZNkfg5%2fKJ5k%2fAfCzuT3OSz%2fbKbzv4l%2fVr6tM0uFD%2fRiq9CiKtze3ButKyDJQl9XkDa9hSMKWNgGnmuoY5IXgU77Mp7ocvMYJvle4fyD%2bP6SKpUteEd4%2b8SVoS8VTljo2%2bXYYFvZsI%2fiRxKiMlws3OdSChzAKq3gX%2fVVWD2IwqyOnqcYJ8bxTUf7BA10xK%2bKTlov6Ovm0665ucSNRWiz36oZAJSt1ZV1pVkXWLML86IWuKbz1AiKMyBdkTR3BCabdeyegYN9hl8R%2byYMYcuzPSTjSm00ZUBOT0CU%2fyQ4MtaHjaMr5xwzlZQJtGN40yKZCY25O6DAFsFPs0pr8HtFFjFDI2cK0DZcJJiMCyfLY32Pet5cEgsZfFKXu%2btSZS%2fkX6EDYEXFKXfjI7DMSpc2K6qratK4KFdHgQp3F1UWlPODkOWeJf68zW2WeK8NRwIeTq%2fc0jjktuID4bIFq%2bbXT0pKX6vbfNE58cvYjMtBSiGKbH0ojc5gLVL2OlQ7P8HZ%2f2aWb7S71oQfSQsGaJku1BGq1avp%2fa50TimLayvojcqAn8vJlvCxc%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script></body>
