$(document).ready(function () {

    // Instance the tour
    var tour = new Tour({
        template: "<div class='popover tour'> <div class='arrow'></div><h3 class='popover-title'></h3> <div class='popover-content'></div><div class='popover-navigation'><button class='btn btn-default'data-role='prev'> <i class='fa fa-angle-left'></i> Ant</button><span data-role='separator'>|</span><button class='btn btn-default' data-role='next'>Sig <i class='fa fa-angle-right'></i> </button><button class='btn btn-default' data-role='end'>Fin</button></div></div>",
        steps: [{
    
                element: "#IngresarProd",
                title: "Ingresar producto",
                content: "Presiona este botón para ir al formulario de ingreso de nuevos productos",
                placement: "left",
                backdrop: true,
                backdropContainer: '#wrapper',
                onShown: function (tour){
                    $('body').addClass('tour-open')
                },
                onHidden: function (tour){
                    $('body').removeClass('tour-close')
                }
            },
            {
                element: "#tablaProd",
                title: "Listado de productos",
                content: "Este es un listado de todos tus productos, se muestran 10 productos por defecto pero puede modificarlo.",
                placement: "top",
                backdrop: true,
                backdropContainer: '#wrapper',
                onShown: function (tour){
                    $('body').addClass('tour-open')
                },
                onHidden: function (tour){
                    $('body').removeClass('tour-close')
                }
            },
            {
                element: "#filter",
                title: "Busqueda en la tabla",
                content: "Con este campo puede realizar una buqueda en la tabla",
                placement: "top",
                backdrop: true,
                backdropContainer: '#wrapper',
                onShown: function (tour){
                    $('body').addClass('tour-open')
                },
                onHidden: function (tour){
                    $('body').removeClass('tour-close')
                }
            },
            {
                element: "#fila-0",
                title: "Acción sobre la fila",
                content: "Al hacer clic sobre la fila se desplegaran los elementes restantes con la información del producto. Adelante haz clic.",
                placement: "top",
                reflex: true
            },
            {
                element: ".footable-row-detail",
                title: "Información faltante del producto",
                content: "Como puedes vez aquí esta el resto de la información de tu producto. Si vuelves a hacer clic sobre la fila se cierra.",
                placement: "top",
            },
            {
                element: "#acciones-0",
                title: "Acciones del producto",
                content: "Este campo te muestra la acciones que puedes realizar sobre un producto si moueves el mouse sobre los botones estos te dirán que acción pueden cumplir",
                placement: "top",
                backdrop: true,
                backdropContainer: '#wrapper',
                onShown: function (tour){
                    $('body').addClass('tour-open')
                },
                onHidden: function (tour){
                    $('body').removeClass('tour-close')
                }
            },
        ]});
    
    // Initialize the tour
    tour.init();
    
    $('.startTour').click(function(){
        tour.restart();
    
        // Start the tour
        // tour.start();
    })
});