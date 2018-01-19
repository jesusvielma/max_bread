@extends('templates.admin.default')
@section('title')
    Mi titulo
@endsection
@section('css')
<link href="<?=base_url('assets/common/js/fancybox/dist/jquery.fancybox.css')?>" type="text/css" rel="stylesheet">
@endsection
@section('js')
    <script src="<?=base_url('assets/common/js/fancybox/dist/jquery.fancybox.js')?>"></script>
@endsection
@section('script')
<script>
    $(document).ready(function (){
        $('[data-fancybox]').fancybox({
            iframe: {
                css: {
                    height: '500px'
                }
            }
        });
    });
function setImage(imagen) {
    $('#imagen').attr('src','{{base_url('assets/common/uploads/')}}'+imagen);
    $.fancybox.close('all');
}
</script>

<script>

    $(document).ready(function (){

        // Instance the tour
        var tour = new Tour({
            template: "<div class='popover tour'> <div class='arrow'></div><h3 class='popover-title'></h3> <div class='popover-content'></div><div class='popover-navigation'><button class='btn btn-default'data-role='prev'> <i class='fa fa-angle-left'></i> Ant</button><span data-role='separator'>|</span><button class='btn btn-default' data-role='next'>Sig <i class='fa fa-angle-right'></i> </button><button class='btn btn-default' data-role='end'>Fin</button></div></div>",
            steps: [{

                    element: "#side-menu",
                    title: "Te damos la bienvenida",
                    content: "Este es tu menú, aquí tienes todos los link para gestionar tu sitio web, ingresar clientes, ver pedidos, entre otros.",
                    placement: "right",
                },
                {
                    element: "#profile-view",
                    title: "Tu perfil",
                    content: "Aquí estas viendo tu perfil.",
                    placement: "right",
                },
                {
                    element: "#stepQuestion",
                    title: "Sobre la pagina y como usarla",
                    content: "Presionando este botón iniciar un tour para ver como debes usar la pagina en cuestión",
                    placement: "bottom"
                },
                {
                    element: "#stepNotif",
                    title: "Notificaciones",
                    content: "Si haces click  sobre esta campana veras las notificas de tu página",
                    placement: "bottom"
                },
                {
                    element: "#stepSalir",
                    title: "Salir",
                    content: "Presiona este link y saldras del sistema",
                    placement: "bottom",
                }
            ]});

        // Initialize the tour
        tour.init();

        $('.startTour').click(function(){
            tour.restart();

            // Start the tour
            // tour.start();
        })

    });

</script>
@endsection
@section('content')
    <div class="wrapper wrapper-content">
        <div class="middle-box text-center animated fadeInRightBig">
            <h3 class="font-bold" id="step1">Bienvenido</h3>
            <div class="error-desc" id="step2">
                Hey, que bueno que estes aquí
            </div>
        </div>
    </div>
@endsection
