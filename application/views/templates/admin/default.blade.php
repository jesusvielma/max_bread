<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ base_url('assets/common/img/favicon.ico') }}">

    <title>MaxBread Administrador | @yield('title') </title>

    <link href="<?=base_url('assets/backend/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/backend/font-awesome/css/font-awesome.css')?>" rel="stylesheet">

    <link href="<?=base_url('assets/backend/css/plugins/bootstrapTour/bootstrap-tour.min.css')?>" rel="stylesheet">

    @yield('css')

    <link href="<?=base_url('assets/backend/css/animate.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/backend/css/style.css')?>" rel="stylesheet">

</head>

<body class="">

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header" id="profile-view">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?=base_url('assets/backend/img/profile_small.jpg')?>" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $this->session->userdata('admin')['correo'] }}</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        MB A
                    </div>
                </li>
                <li class="{{ $this->uri->segment(2) == 'cliente' ? 'active' : ''}}">
                    <a><i class="fa fa-users"></i> <span class="nav-label">Clientes</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?=site_url('administrador/cliente')?>">Ver</a></li>
                        <li><a href="{{ site_url('administrador/cliente/crear') }}">Ingresar</a></li>
                    </ul>
                </li>
                <li class="{{ $this->uri->segment(2) == 'empresa' ? 'active' : '' }}">
                    <a href="{{ site_url('administrador/empresa') }}"><i class="fa fa-diamond"></i> <span class="nav-label">Empresa</span></a>
                </li>
                <li class="{{ $this->uri->segment(2) == 'categoria' || $this->uri->segment(2) == 'producto'  ? 'active' : '' }}">
                    <a ><i class="fa fa-shopping-cart"></i> <span class="nav-label">Productos</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ site_url('administrador/producto') }}">Productos</a></li>
                        <li><a href="{{ site_url('administrador/categoria') }}">Categorias</a></li>
                    </ul>
                </li>
                <li class="{{ $this->uri->segment(2) == 'slider' ? 'active' : '' }}">
                    <a href="{{ site_url('administrador/slider') }}"><i class="fa fa-photo"></i> <span class="nav-label">Destacados</span></a>
                </li>
                <li class="{{ $this->uri->segment(2) == 'pedido' ? 'active' : '' }}">
                    <a href="{{ site_url('administrador/pedido') }}"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Pedidos</span></a>
                </li>
                <li>
                    <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span></a>
                </li>
                <li>
                    <a href="empty_page.html#"><i class="fa fa-sitemap"></i> <span class="nav-label">Menu Levels </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="empty_page.html#">Third Level <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="empty_page.html#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="empty_page.html#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="empty_page.html#">Third Level Item</a>
                                </li>

                            </ul>
                        </li>
                        <li><a href="empty_page.html#">Second Level Item</a></li>
                        <li>
                            <a href="empty_page.html#">Second Level Item</a></li>
                        <li>
                            <a href="empty_page.html#">Second Level Item</a></li>
                    </ul>
                </li>
                <!--<li>
                    <a href="css_animation.html"><i class="fa fa-magic"></i> <span class="nav-label">CSS Animations </span><span class="label label-info pull-right">62</span></a>
                </li>
                <li class="landing_link">
                    <a target="_blank" href="landing.html"><i class="fa fa-star"></i> <span class="nav-label">Landing Page</span> <span class="label label-warning pull-right">NEW</span></a>
                </li>
                <li class="special_link">
                    <a href="package.html"><i class="fa fa-database"></i> <span class="nav-label">Package</span></a>
                </li>-->
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <!-- <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form> -->
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Bienvenido al administrador de MaxBread</span>
                </li>
                <li id="stepQuestion">
                    <a href="#" class="startTour"><i class="fa fa-question"></i></a>
                </li>
                <li class="dropdown" id="stepNotif">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="empty_page.html#">
                        <i class="fa fa-bell"></i>  <span class="label label-success" id="cantiNotif"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages" >
                        <!-- <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>-->
                        <!--<li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>-->
                        <div id="notifs" >

                        </div>
                    </ul>
                </li>
                <li id="stepSalir">
                    <a href="<?=site_url('administrador/login/salir')?>">
                        <i class="fa fa-sign-out"></i> Salir
                    </a>
                </li>
            </ul>

        </nav>
        </div>
        @yield('content')
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

        </div>
        </div>

        <!-- Mainly scripts -->
        <script src="<?=base_url('assets/backend/js/jquery-3.1.1.min.js')?>"></script>
        <script src="<?=base_url('assets/backend/js/bootstrap.min.js')?>"></script>
        <script src="<?=base_url('assets/backend/js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
        <script src="<?=base_url('assets/backend/js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>

        @yield('js')
        <!-- Custom and plugin javascript -->
        <script src="<?=base_url('assets/backend/js/inspinia.js')?>"></script>
        <script src="<?=base_url('assets/backend/js/plugins/pace/pace.min.js')?>"></script>
        <script src="<?=base_url('assets/common/js/timeago/jquery.timeago.js')?>"></script>
        <script src="<?=base_url('assets/common/js/timeago/jquery.timeago.es.js')?>"></script>
        <script src="<?=base_url('assets/backend/js/plugins/bootstrapTour/bootstrap-tour.min.js')?>"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                get_notifications();
                $('#notifs').slimScroll({
                    height: '250px',
                    railOpacity: 0.7,
                });
            });

            function get_notifications(){
                $.get('{{ base_url('administrador/inicio/obtener_notificaciones') }}', function (data) {
                    if (data) {
                        var output = '';
                        var total = data.notifs.length - 1;
                        var sinLeer = 0;
                        for (var i in data.notifs){
                            var contenido = data.notifs[i]['contenido'];
                            contenido = JSON.parse(contenido);
                            output+= "<li>";
                            output+= "<div class='dropdown-messages-box'>";
                            if (contenido.avatar) {
                                output+= "<a href='#' class='pull-left'>";
                                output+= "<img alt='Avatar de cliente' class='img-circle' src='"+ contenido.avatar +"'>";
                                output+= "</a>";
                            }
                            output+= "<div class='media-body'>"
                            output+= "<small class='pull-right'>"+ $.timeago(data.notifs[i]['fecha']) +"</small>"
                            output+= contenido.text+"<br>"
                            if (contenido.fecha) {
                                output+= "<small class='text-muted'> Relizado "+ $.timeago(contenido.fecha) +"</small>"
                            }
                            output+= "</div>"
                            output+= "</div>"
                            output+= "</li>"
                            if (total != i) {
                                output+= "<li class='divider'></li>"
                            }

                            if (data.notifs[i]['estado'] == '0') {
                                sinLeer++;
                            }
                        }
                        $('#notifs').html(output);
                        $('#cantiNotif').html(sinLeer).fadeIn();
                    }
                    setTimeout('get_notifications()',60000);
                });
            }
        </script>
        @yield('script')
    </body>
</html>
