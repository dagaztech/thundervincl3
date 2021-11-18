@extends('layouts.app')

@section('content')
    <section class="content-header new-camp">
        <h1> Crear Nueva Campa&ntilde;a</h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <!--div class="row" style="margin-left:1px;">
                    <div class="panel panel-default col-xs-8 lefty">
                        <div class="panel-body">
                            <strong>NOTA IMPORTANTE:</strong>
                        </div>
                    </div>
                </div-->
                <div class="row">
                    {!! Form::open(['route' => 'vinsvokls.store', 'enctype' => 'multipart/form-data']) !!}

                    @include('vins.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

            $('form').submit(function (e) {
                code = $('input[name="campana"]').val()

                if(code == ""){
                    alert("Recuerda ingresar un código para la campaña")
                    return false
                }

                name = $('input[name="nombre"]').val()
                if(name == ""){
                    alert("Recuerda ingresar un nombre para la campaña")
                    return false
                }
                
            });

            //creacion de inputs adicionales para lineas afectadas por campanas y modelos vehiculos afectados
            $('#add-lineas').click(function (e) {
                e.preventDefault();

                var input_lineas = $("<input/>", {
                    type: "text",
                    class: "form-control lineas_afectadas_por_campanas",
                    id: "lineas_afectadas_por_campanas",
                    name: "lineas_afectadas_por_campanas[]"
                });
                var input_modelos = $("<input/>", {
                    type: "text",
                    class: "form-control modelos_vehiculos_afectados",
                    id: "modelos_vehiculos_afectados",
                    name: "modelos_vehiculos_afectados[]"
                });

                $('#lineas-afectadas').after().append(input_lineas);
                $('#modelos-afectados').after().append(input_modelos);
            });


            //eliminacion de inputs adicionales para lineas afectadas por campanas y modelos vehiculos afectados
            $('#rm-lineas').click(function (e) {
                e.preventDefault();
                $('.modelos_vehiculos_afectados').last().remove();
                $('.lineas_afectadas_por_campanas').last().remove();
                console.log($('#lineas_afectadas_por_campanas').last().val())
            });
        });
    </script>
@endsection
