<?php $user = Util::current_user();
$categories = CategoryMenuData::get_base_categories();
    if (isset($_GET['view'])) {
        if (($_GET['view']!="fechafirmapublico")&&($_GET['view']!="consultatramite")&&($_GET['view']!="processlogin")&&($_GET['view']!="consultatramiteresultado")&&($_GET['view']!="emailsuccess")&&($_GET['view']!="emailto")) {
            Session::getLogin();
        }
    }
?>
<!doctype html>
<html lang="es-co">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>
        <?php if (!empty($page_title)) {
    echo Util::remove_junk($page_title);
} elseif (!empty($user)) {
    echo ucfirst($user->name);
} else {
    echo "Sistema de administrador de contenido Notaria 62 del circulo de Bogotá";
}?>
    </title>
    <link rel="apple-touch-icon" sizes="57x57" href="themes/notaria62web/img/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="themes/notaria62web/img/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="themes/notaria62web/img/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="themes/notaria62web/img/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="themes/notaria62web/img/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="themes/notaria62web/img/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="themes/notaria62web/img/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="themes/notaria62web/img/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="themes/notaria62web/img/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="themes/notaria62web/img/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="themes/notaria62web/img/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="themes/notaria62web/img/favicon-16x16.png" />
    <link rel="manifest" href="themes/notaria62web/img/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="themes/notaria62web/img/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700%7CRoboto+Slab:400,700%7CMaterial+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="themes/notaria62web/css/material-dashboard-v=2.0.1.css">
    <link rel="stylesheet" href="themes/notaria62web/css/material-dashboard-print.css" media="print" />

    <!--   Core JS Files   -->
    <script src="themes/notaria62web/js/core/jquery.min.js"></script>
    <script src="themes/notaria62web/js/core/popper.min.js"></script>
    <script src="themes/notaria62web/js/bootstrap-material-design.js"></script>
    <script src="themes/notaria62web/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
    <script src="themes/notaria62web/js/plugins/moment.min.js"></script>
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker 
    <script src="themes/notaria62web/js/plugins/bootstrap-datetimepicker.min.js"></script>-->
    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ 
    <script src="themes/notaria62web/js/plugins/nouislider.min.js"></script>-->
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="themes/notaria62web/js/plugins/bootstrap-selectpicker.js"></script>
    <!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/  -->
    <script src="themes/notaria62web/js/plugins/bootstrap-tagsinput.js"></script>
    <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="themes/notaria62web/js/plugins/jasny-bootstrap.min.js"></script>
    <!-- Plugins for presentation and navigation  -->
    <script src="themes/notaria62web/assets-for-demo/js/modernizr.js"></script>
    <script src="themes/notaria62web/assets-for-demo/js/vertical-nav.js"></script>
    <!-- Material Dashboard Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="themes/notaria62web/js/material-dashboard-v=2.0.1.js"></script>
    <!-- Dashboard scripts -->
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="themes/notaria62web/js/plugins/arrive.min.js" type="text/javascript"></script>
    <!-- Forms Validations Plugin -->
    <script src="themes/notaria62web/js/plugins/jquery.validate.min.js"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="themes/notaria62web/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
    <script src="themes/notaria62web/js/plugins/bootstrap-notify.js"></script>
    <!--    Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
    <script src="themes/notaria62web/js/plugins/nouislider.min.js"></script>
    <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="themes/notaria62web/js/plugins/jquery.select-bootstrap.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/   -->
    <script src="themes/notaria62web/js/plugins/datatables.min.js"></script>

    <!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
    <script src="themes/notaria62web/js/plugins/sweetalert2.js"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="themes/notaria62web/js/plugins/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="themes/notaria62web/js/plugins/fullcalendar.min.js"></script>

    <link rel="stylesheet" href="themes/notaria62web/css/datepicker.min.css">
    <script src="themes/notaria62web/js/plugins/datepicker.min.js"></script>
    <script src="themes/notaria62web/js/plugins/datepicker.es.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {

    });
    </script>
</head>

<body class="">
    <?php if (count($user)>0):
        $fullname = $user->name." ".$user->lastname;
        $name = $user->name;
        $gender = $user->gender;
        ?>
    <div class="wrapper">
        <div class="sidebar" data-color="rose" data-background-color="white"
            data-image="themes/notaria62web/img/sidebar-1.jpg">
            <div class="logo">
                <a href="./" class="simple-text logo-mini">
                    62
                </a>
                <a href="/" class="simple-text logo-normal">
                    <img src="themes/notaria62web/img/logo.png" alt="Notaria 62" height="40" width="40" />
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <?= ($gender=='1')?'<img src="themes/notaria62web/img/male.png" />':'<img src="themes/notaria62web/img/female.png" />'?>
                    </div>
                    <div class="user-info">
                        <a data-toggle="collapse" href="#collapseuser" class="username">
                            <span>
                                <?=$name ?>
                                <b class="caret"></b>
                            </span>
                        </a>
                        <div class="collapse" id="collapseuser">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini">MP</span>
                                        <span class="sidebar-normal">Mi perfil </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini">EP</span>
                                        <span class="sidebar-normal">Editar perfil </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./?view=configuration">
                                        <span class="sidebar-mini"><i class="material-icons">security</i></span>
                                        <span class="sidebar-normal">Cambiar contrase&ntilde;a</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">
                                        <span class="sidebar-mini"><i
                                                class="material-icons">power_settings_new</i></span>
                                        <span class="sidebar-normal">Salir</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php if (count($categories)>0):?>
                <ul class="nav">
                    <?php foreach ($categories as $cat):
                        $view_id = CategoryMenuData::isUserGroupCategoryMenu($cat->id, $user->user_level);
                         if ($user->user_level== $view_id): ?>
                    <li class="nav-item ">
                        <a class="nav-link" data-toggle="collapse" href="#<?=$cat->id;?>">
                            <i class="material-icons"><?=$cat->icon;?></i>
                            <p><?=$cat->name;?>
                                <b class="caret"></b>
                            </p>
                        </a>
                        <?php
                    CategoryMenuData::list_tree_cat_id_user($cat->id); ?>
                        <?php endif; endforeach; ?>
                    </li>
                </ul>
                <?php else:?>
                <p class="alert alert-danger">No hay menu creado</p>
                <?php endif;?>

            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                            </button>
                        </div>
                        <a class="navbar-brand" href="./">Sistema ADC de Notaria 62</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <form class="navbar-form">
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" placeholder="Buscar..." />
                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </form>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="./">
                                    <i class="material-icons">dashboard</i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Stats</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="./" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">5</span>
                                    <p class="d-lg-none d-md-block">Some Actions</p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Mike John responded to your email</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="./" id="navbarDropdownProfile" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">person</i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a class="dropdown-item" href="logout.php"><i
                                            class="material-icons">power_settings_new</i>
                                        Salir</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <?php View::load("login"); ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="./?view=changelog">
                                    Log de cambios
                                </a>
                            </li>
                            <li>
                                <a href="//adc.notaria62bogota.com/" target="_blank">
                                    Notaria62 ADC
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right"> <a href="//adc.notaria62bogota.com" target="_blank">Notaria62
                            ADC</a>&copy;
                        2018
                    </p>
                </div>
            </footer>
        </div>
    </div>
    <?php else:
        View::load("login");    ?>



    <?php endif;?>



</body>

</html>