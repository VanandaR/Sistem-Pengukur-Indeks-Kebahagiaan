<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="/assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/assets/img/favicon-32x32.png" sizes="32x32">

    <title>@yield('judul')</title>


    <!-- uikit -->
    <link rel="stylesheet" href="/bower_components/uikit/css/uikit.almost-flat.min.css" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="/assets/icons/flags/flags.min.css" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="/assets/css/main.min.css" media="all">
    <!-- chartjs-->
    <script src="/assets/js/chartjs.js"></script>
    <!-- additional styles for plugins -->
    <!-- metrics graphics (charts) -->
    <link rel="stylesheet" href="/bower_components/metrics-graphics/dist/metricsgraphics.css">
    <!-- c3.js (charts) -->
    <link rel="stylesheet" href="/bower_components/c3js-chart/c3.min.css">
    <!-- chartist -->
    <link rel="stylesheet" href="/bower_components/chartist/dist/chartist.min.css">

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
    <script type="text/javascript" src="/bower_components/matchMedia/matchMedia.js"></script>
    <script type="text/javascript" src="/bower_components/matchMedia/matchMedia.addListener.js"></script>
    <![endif]-->

</head>
<body class=" sidebar_main_open sidebar_main_swipe">
<!-- main header -->
<header id="header_main">
    <div class="header_main_content">
        <nav class="uk-navbar">

            <!-- main sidebar switch -->
            <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                <span class="sSwitchIcon"></span>
            </a>

            <!-- secondary sidebar switch -->
            <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                <span class="sSwitchIcon"></span>
            </a>

            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav user_actions">
                    <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">&#xE5D0;</i></a></li>
                    <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                        <a href="#" class="user_action_image"><img class="md-user-image" src="/assets/img/avatars/avatar_11_tn.png" alt=""/></a>
                        <div class="uk-dropdown uk-dropdown-small">
                            <ul class="uk-nav js-uk-prevent">
                                <li><a href="/logout">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="header_main_search_form">
        <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
        <form class="uk-form">
            <input type="text" class="header_main_search_input" />
            <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i></button>
        </form>
    </div>
</header><!-- main header end -->
<!-- main sidebar -->
<aside id="sidebar_main">

    <div class="sidebar_main_header">
        <div class="sidebar_logo">

        </div>
    </div>

    <div class="menu_section">
        <ul>
            <li title="Dashboard">
                <a href="/home">
                    <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                    <span class="menu_title">Dashboard</span>
                </a>
            </li>
            <li title="Tweet">
                <a href="/tweet">
                    <span class="menu_icon"><i class="material-icons">&#xe1b3;</i></span>
                    <span class="menu_title">Tweet</span>
                </a>
            </li>
            @if(Auth::user()->role_id==1)
            <li title="Data Training">
                <a href="#">
                    <span class="menu_icon"><i class="material-icons">&#xe85d;</i></span>
                    <span class="menu_title">Data Training</span>
                </a>
                <ul>
                    <li><a href="/datatraining/tabel">Tabel</a></li>
                    <li><a href="/datatraining/preprocessing">Text Mining</a></li>
                </ul>
            </li>
            <li title="Data Testing">
                <a href="#">
                    <span class="menu_icon"><i class="material-icons">&#xe862;</i></span>
                    <span class="menu_title">Data Testing</span>
                </a>
                <ul>
                    <li><a href="/datatesting/tabel">Tabel</a></li>
                    <li><a href="/datatesting/preprocessing">Text Mining</a></li>
                    <li><a href="/datatesting/klasifikasi">Klasifikasi</a></li>
                    <li><a href="/datatesting/indekskebahagiaan">Indeks Kebahagiaan</a></li>
                </ul>
            </li>
            <li title="Stopword">
                <a href="/stopword">
                    <span class="menu_icon"><i class="material-icons">&#xe865;</i></span>
                    <span class="menu_title">Stopword</span>
                </a>
            </li>

            <li title="Ontology">
                <a href="/ontology">
                    <span class="menu_icon"><i class="material-icons">&#xe866;</i></span>
                    <span class="menu_title">Ontologi</span>
                </a>
            </li>
                <li title="Streaming">
                    <a href="/streaming">
                        <span class="menu_icon"><i class="material-icons">&#xe85c;</i></span>
                        <span class="menu_title">Indeks Kebahagiaan</span>
                    </a>
                </li>
                <li title="User">
                    <a href="/user">
                        <span class="menu_icon"><i class="material-icons">&#xE87C;</i></span>
                        <span class="menu_title">User</span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->role_id==2)
                <li title="Data Training">
                    <a href="/datatraining/tabel">
                        <span class="menu_icon"><i class="material-icons">&#xe85d;</i></span>
                        <span class="menu_title">Data Training</span>
                    </a>
                </li>
                <li title="Data Testing">
                    <a href="/datatesting/tabel">
                        <span class="menu_icon"><i class="material-icons">&#xe862;</i></span>
                        <span class="menu_title">Data Testing</span>
                    </a>
                </li>
                <li title="FAQ">
                    <a href="/FAQ">
                        <span class="menu_icon"><i class="material-icons">&#xe87f;</i></span>
                        <span class="menu_title">FAQ</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside><!-- main sidebar end -->
@yield('konten')
<script>
    WebFontConfig = {
        google: {
            families: [
                'Source+Code+Pro:400,700:latin',
                'Roboto:400,300,500,700,400italic:latin'
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
<script src="/assets/js/common.min.js"></script>
<!-- uikit functions -->
<script src="/assets/js/uikit_custom.min.js"></script>
<!-- altair common functions/helpers -->
<script src="/assets/js/altair_admin_common.min.js"></script>
<!-- page specific plugins -->

<!-- datatables -->
<script src="/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<!-- datatables colVis-->
<script src="/bower_components/datatables-colvis/js/dataTables.colVis.js"></script>
<!-- datatables tableTools-->
<script src="/bower_components/datatables-tabletools/js/dataTables.tableTools.js"></script>
<!-- datatables custom integration -->
<script src="/assets/js/custom/datatables_uikit.min.js"></script>
<!--  datatables functions -->
<script src="/assets/js/pages/plugins_datatables.min.js"></script>
<!--  notifications functions -->
<script src="/assets/js/pages/components_notifications.min.js"></script>
<!--  mailbox functions -->
<script src="/assets/js/pages/page_mailbox.min.js"></script>

<!-- ionrangeslider -->
<script src="/bower_components/ion.rangeslider/js/ion.rangeSlider.min.js"></script>

<!--form advanced-->
<script src="/assets/js/pages/forms_advanced.min.js"></script>


<!-- help -->
<script src="/assets/js/pages/page_help.min.js"></script>






<script>
    $(function() {
        // enable hires images
        altair_helpers.retina_images();
        // fastClick (touch devices)
        if(Modernizr.touch) {
            FastClick.attach(document.body);
        }
    });
</script>


<div id="style_switcher">
    <div id="style_switcher_toggle"><i class="material-icons">&#xE8B8;</i></div>
    <div class="uk-margin-medium-bottom">
        <h4 class="heading_c uk-margin-bottom">Colors</h4>
        <ul class="switcher_app_themes" id="theme_switcher">
            <li class="app_style_default active_theme" data-app-theme="">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_a" data-app-theme="app_theme_a">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_b" data-app-theme="app_theme_b">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_c" data-app-theme="app_theme_c">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_d" data-app-theme="app_theme_d">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_e" data-app-theme="app_theme_e">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_f" data-app-theme="app_theme_f">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_g" data-app-theme="app_theme_g">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
        </ul>
    </div>
    <div class="uk-visible-large uk-margin-medium-bottom">
        <h4 class="heading_c">Sidebar</h4>
        <p>
            <input type="checkbox" name="style_sidebar_mini" id="style_sidebar_mini" data-md-icheck />
            <label for="style_sidebar_mini" class="inline-label">Mini Sidebar</label>
        </p>
    </div>
    <div class="uk-visible-large">
        <h4 class="heading_c">Layout</h4>
        <p>
            <input type="checkbox" name="style_layout_boxed" id="style_layout_boxed" data-md-icheck />
            <label for="style_layout_boxed" class="inline-label">Boxed layout</label>
        </p>
    </div>
</div>

<script>
    $(function() {
        var $switcher = $('#style_switcher'),
                $switcher_toggle = $('#style_switcher_toggle'),
                $theme_switcher = $('#theme_switcher'),
                $mini_sidebar_toggle = $('#style_sidebar_mini'),
                $boxed_layout_toggle = $('#style_layout_boxed'),
                $body = $('body');


        $switcher_toggle.click(function(e) {
            e.preventDefault();
            $switcher.toggleClass('switcher_active');
        });

        $theme_switcher.children('li').click(function(e) {
            e.preventDefault();
            var $this = $(this),
                    this_theme = $this.attr('data-app-theme');

            $theme_switcher.children('li').removeClass('active_theme');
            $(this).addClass('active_theme');
            $body
                    .removeClass('app_theme_a app_theme_b app_theme_c app_theme_d app_theme_e app_theme_f app_theme_g')
                    .addClass(this_theme);

            if(this_theme == '') {
                localStorage.removeItem('altair_theme');
            } else {
                localStorage.setItem("altair_theme", this_theme);
            }

        });

        // hide style switcher
        $document.on('click keyup', function(e) {
            if( $switcher.hasClass('switcher_active') ) {
                if (
                        ( !$(e.target).closest($switcher).length )
                        || ( e.keyCode == 27 )
                ) {
                    $switcher.removeClass('switcher_active');
                }
            }
        });

        // get theme from local storage
        if(localStorage.getItem("altair_theme") !== null) {
            $theme_switcher.children('li[data-app-theme='+localStorage.getItem("altair_theme")+']').click();
        }


        // toggle mini sidebar

        // change input's state to checked if mini sidebar is active
        if((localStorage.getItem("altair_sidebar_mini") !== null && localStorage.getItem("altair_sidebar_mini") == '1') || $body.hasClass('sidebar_mini')) {
            $mini_sidebar_toggle.iCheck('check');
        }

        $mini_sidebar_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_sidebar_mini", '1');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_sidebar_mini');
                    location.reload(true);
                });


        // toggle boxed layout

        // change input's state to checked if mini sidebar is active
        if((localStorage.getItem("altair_layout") !== null && localStorage.getItem("altair_layout") == 'boxed') || $body.hasClass('boxed_layout')) {
            $boxed_layout_toggle.iCheck('check');
            $body.addClass('boxed_layout');
            $(window).resize();
        }

        // toggle mini sidebar
        $boxed_layout_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_layout", 'boxed');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_layout');
                    location.reload(true);
                });


    });
</script>
</body>
</html>