<!DOCTYPE html>
<?php
$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*';
$origin = isset($_SERVER['HTTPS_ORIGIN']) ? $_SERVER['HTTPS_ORIGIN'] : '*';
header("Access-Control-Allow-Origin: *"); 
header('Access-Control-Allow-Origin: '.$origin);
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Origin: https://campanas-servicio.cl/');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Body, Content-Type, X-Auth-Token , Authorization, Accept, Methods');
?>
<html lang="es">

<head>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
      <meta name="robots" content="noindex">
      <meta name="googlebot" content="noindex">
        <title>Campañas de Servicio | MAN Chile</title>
        <link rel="shortcut icon" href="https://www.manchile.cl/wp-content/themes/camiones/img/favicon.ico" type="image/x-icon">
        <link rel="icon" type="image/png" href="frontend/img/man/favicon.ico">
        <link rel="manifest" href="https://www.MAN.esfavicons/manifest.json">
        <link rel="shortcut icon" href="{{ asset('frontend/img/man/favicon.ico') }}">
         <link href="../../frontend/vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">

        <!-- Bootstrap core CSS -->
         <link href="../../frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Fuentes -->
         <link href="../../frontend/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet"
              type="text/css">
         <link href="../../frontend/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet"
              type="text/css">

        <!-- Estilos propios -->
         <link href="../../frontend/css/man/base.min.css" rel="stylesheet">
         <link href="../../frontend/css/man/man-thundervin.css" rel="stylesheet">
        <link href="https://www.manchile.cl/wp-content/themes/camiones/fonts/MAN/stylesheet.css">
        <link href="https://www.manchile.cl/wp-content/themes/camiones/fonts/franklin/stylesheet.css">
        <link href="https://www.manchile.cl/wp-content/themes/camiones/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="{{ asset('js/megamenu.js') }}"></script>
      <script src="{{ asset('js/validacioness.js') }}"></script>
      <link href="{{ asset('css/front.css') }}" rel="stylesheet">
    </head>

<body id="page-top" class="man-body">


<!-- Contenido -- >
<section class="content-section inner-sections" id="contenido">
    <div class="container text-left">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <h2><b>Campañas de Seguridad</b> y Servicio</h2>
                <div class="card-text">
                    <p>Las Campañas de Seguridad (Recalls) y de Servicio, son programas definidos por MAN, gestionados por el importador Porsche Chile SpA y ejecutadas por la red de concesionarios autorizados MAN en Chile, sin ningún costo para el propietario y orientadas a mejorar o subsanar condiciones de seguridad o de calidad de algún componente específico (hardware) o programación (software) que sea requerido para garantizar el desempeño, seguridad y confort de tu MAN. En el caso de que alguna de estas medidas de servicio afectara la seguridad del auto, éstas serán también informadas al SERNAC.</p>
                    <button id="BtnCollapse" class="btn btn-manbtn" type="button" data-target="#collapsePolitics" aria-expanded="true">
                        Ver más
                    </button>
                    <div id="collapsePolitics" style="display:none;">
                        <p>Para saber si tu MAN tiene una campaña por realizar, debes registrar el número VIN (17 caracteres alfa numéricos) en el recuadro correspondiente. Si se desplegara información sobre alguna campaña que aplique a tu vehículo, debes comunicarte con el concesionario MAN de tu confianza para agendar una cita, con el fin de realizar lo más pronto posible todas las revisiones y reparaciones que tu vehículo MAN requiera. Si deseas obtener mayor información, también puedes comunicarte con nosotros a través de nuestros canales de comunicación de servicio al cliente MAN: <a href="https://www.manchile.cl/contacto/">Selecciona aquí</a>.</p>
                        <p>En MAN, Porsche Chile y la Red de Concesionarios MAN estamos comprometidos en generar experiencias memorables a pesar de las incomodidades que puedan ocasionar este tipo de actividades, que van encaminadas a ofrecer el respaldo permanente de MAN evolucionando y avanzando técnicamente en todo el portafolio de vehículos y servicios.</p>
                        <p>Te reiteramos que todos los trabajos y repuestos asociados con cualquiera de las campañas que se apliquen al vehículo, no tendrán costo para ti como propietario y que además incluirán gratuitamente, una revisión del estado actual de tu vehículo en caso de no contar con un historial de registros actualizados de mantenimiento o revisiones programadas en nuestros talleres de servicio autorizado MAN.</p>
                    </div>
                    <h2>¿Dónde puedo localizar <b>el número VIN de mi vehículo?</b></h2>
                </div>
            </div>
        </div>
    </div>
</section>-->

<!-- vines -->
<section class="content-section inner-sections" id="vinx">
    <div class="text-left">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="row vin-holder">
                    <!--CARRUSEL
                    <div class="col-lg-1 col-md-1 col-sm-12">
                    <img src="{{ asset('frontend/img/man/padron-man.png'),true }}" alt="Padrón" class="front-property-card">

                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                               
                                <div class="carousel-item active">
                                    <img class="d-block w-100 m-auto" src="{{ asset('frontend/img/man/slider-man-1.png') }}" alt="MAN Padrón 1">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 m-auto" src="{{ asset('frontend/img/man/slider-man-2.png') }}" alt="MAN Padrón 2">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 m-auto" src="{{ asset('frontend/img/man/slider-man-3.png') }}" alt="MAN Padrón 3">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 m-auto" src="{{ asset('frontend/img/man/slider-man-4.png') }}" alt="MAN Padrón 4">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Siguiente</span>
                            </a>
                        </div>
                        
                    </div>-->
                    <div class="col-lg-10 col-md-10 col-sm-12" style="margin-left:1em;">
                        <form id="search-vin" style="margin-top: 1%;">
                            <div class="form-row">
{{--                                <div class="col-12 col-md-12"><h2>INGRESE EL RUT AQUÍ:</h2></div>--}}

{{--                                <div class="filter--field-container filterdisplay">--}}
{{--                                    <div class="form-group is-focusable">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-11">--}}
{{--                                                <div class="input-group has-right-btn has-feedback">--}}
{{--                                                    <input type="text" name="rut" id="rut"--}}
{{--                                                           class="form-control search--query" onkeyup="validaRutGet()"--}}
{{--                                                           clear_input_button="true" autocomplete="off"--}}
{{--                                                           placeholder="Escriba su RUT aquí" data-toggle="tooltip"--}}
{{--                                                           data-placement="top"--}}
{{--                                                           title="El valor ingresado no parece ser un RUT. Por favor verifique e intente de nuevo."--}}
{{--                                                           data-placement="top" required>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-1">--}}
{{--                                                <label class="conta cheket" style="display: none">--}}
{{--                                                    <input type="checkbox" value="" id="checkbox" checked disabled--}}
{{--                                                           style="height: 25px;width: 25px;top: -40%;">--}}
{{--                                                    <span class="checkmark"></span>--}}
{{--                                                </label>--}}

{{--                                                <label class="uncheket">--}}
{{--                                                    <input type="checkbox" value="" id="checkbox" disabled--}}
{{--                                                           style="height: 25px;width: 25px;top: -40%;">--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <p id="error-rut" class="msg-error"></p>--}}
{{--                                </div>--}}

                                <div class="col-12 col-md-12"><h2>INGRESA EL VIN AQUÍ:</h2></div>
                                <div class="filter--field-container filterdisplay">
                                    <div class="form-group is-focusable">
                                        <label class="hidden" for="vines">Buscar</label>
                                        <div class="input-group has-right-btn has-feedback">
                                            <input type="text" name="vines" id="vines" onkeyup="validaVin(7)"
                                            class="form-control search--query" clear_input_button="true"
                                            autocomplete="off" placeholder="Escribe un VIN de 17 caracteres"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Debes digitar un VIN con 17 caracteres. Por verificación de seguridad de datos, no debes copiar/pegar tu número de VIN en este espacio, solo escribirlo. Si se presenta algún error, por favor verifica e intenta digitar de nuevo."
                                            maxlength="17" onpaste="return false;">
                                                    <p id="error-data" class="msg-error">Tu vehículo actualmente no presenta campañas pendientes por realizar.
                                    </p>
                                    <hr>
                                                   
                                                               <label id="habeasdater"><input type="checkbox" name="prog" value="value">&nbsp;Por el solo uso de esta herramienta autorizo a Porsche Chile SpA, y sus empresas relacionadas, conforme lo establecido en el artículo 4 de la Ley 19.628, a tratar mis datos personales y no personales con la finalidad de realizar análisis de servicios y estadísticas para la marca MAN</label>
                                                   
                                            <div class="input-group-btn btnmann">
                                                <button class="btn searchbtn2 btn-manbtn" type="submit"  id="magicbutton" style="display: none">
                                                    <span class="spec-label"> Consultar </span>
                                                    <i class="icon amc-icon is-search-g28"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="preaccordion" class="pre-accordion">
{{--                                        <p>Estimado Cliente: La(s) siguiente(s) campaña(s) está(n) pendiente(s):<br>--}}
{{--                                            <small><i>Favor de seleccionar el código de la campaña para visualizar--}}
{{--                                                    detalles de ésta.</i></small>--}}
{{--                                        </p>--}}
                                    </div>
                                    <div id="accordion" class="vins-accordion">
                                    </div>
                                   
                                    <p id="button-data" class="msg-ok"><a
                                                href="https://www.manchile.cl/sucursales/" target="_top"
                                                class="button-cons btn searchbtn2 btn-manbtn">Ver nuestros concesionarios</a></p>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-12"></div>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- Bootstrap core JavaScript -->
<script src="../../frontend/vendor/jquery/jquery.min.js"></script>

<script src="../../frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('#data-vin').hide();
        $('#error-data').hide();
        $('#button-data').hide();
        $('#preaccordion').hide();

        $("form").keypress(function(e) {
            if (e.which == 13) {
                return false;
            }
        });
        $('#search-vin').submit(function (event) {
            //var data = new FormData(this);

            event.preventDefault();
            vines = $('#vines').val();
            if(vines.length == 17 && $('input[name=prog]').is(":checked")){
                var url = "{{ route('vinsman.search') }}?marca=7"
                url = url.replace("http", "http")
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "vines": $('#vines').val(),
                        "rut": $('#rut').val(),
                    },
                    success: function (data) {
                        $('#preaccordion').show();
                        $('#accordion').collapse('dispose');
                        $('#error-data').html('');
                        $('#error-data').hide();
                        $('#accordion').html(data);
                        $('#accordion').show();
                        $('#accordion').collapse();
                        $('#button-data').show();
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        var mensaje = 'Se presentó un error inesperado. Por favor intenta más tarde o recarga tu navegador.';
                        if (XMLHttpRequest.status == 400) {
                            if (XMLHttpRequest.responseText != null && XMLHttpRequest.responseText != '') {
                                $('#error-data').html(XMLHttpRequest.responseText);
                            } else {
                                $('#error-data').html(campanasNoAsociadaVin);
                            }
                        } else {
                            $('#error-data').html(mensaje);
                        }

                        $('#error-data').show();
                        $('#accordion').html('');
                        $('#accordion').hide();
                        $('#button-data').hide();
                        $('#preaccordion').hide();
                    }
                });
            }
        });
        $("#BtnCollapse").click(function () {
            $("#collapsePolitics").toggle("slow");
        });

    });
</script>

<!-- Plugin JavaScript -->
<script src="../../frontend/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom JavaScript for this theme -->
<script src="../../frontend/js/scrolling-nav.js"></script>
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
<!-- Custom scripts for this template -->
<script src="../../frontend/js/base.min.js"></script>
<script src="../../frontend/js/scroll-menu.js"></script>


<script>
    $(window).scroll(function () {
        if ($(this).scrollTop() < 800) {
            $('.logobarblue').removeClass("fader");
            $('.menu-toggle').removeClass("bluemenu");
        } else {
            $('.logobarblue').addClass("fader");
            $('.menu-toggle').addClass("bluemenu");
        }
    });
</script>
<script>
$(document).ready(function() {

    var $submit = $("#magicbutton").hide(),
        $cbs = $('input[name="prog"]').click(function() {
            $submit.toggle( $cbs.is(":checked") );
            if($cbs.is(":checked") && $('#vines').val() == ''){
                $submit.toggle( false );
            }
        });

});
</script>
</body>

</html>
