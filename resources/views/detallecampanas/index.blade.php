@extends('layouts.app')

@section('content')
    <section class="content-header">
        @if (isset($marca))
            <h1 class="pull-left">{{ strtoupper($marca->nombre) }}</h1>
        @else
            <h1 class="pull-left">Generaci&oacute;n de Hist&oacute;ricos</h1>
        @endif
        <div class="pull-right">
         </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @if(isset($marcas))
                <div class="col-md-12">
                    <p>Ingrese los datos para generar el reporte</p>
                </div>
                <form id="reporte-form" target="_blank" action="{{ route('detallecampana.exportar.marca') }}" method="post">
                    {{csrf_field()}}
                    <div class="form-group col-sm-3">
                        <select name="marca_id" id="marca_id" class="form-control" >
                            <option value="">Seleccionar marca</option>
                            @foreach ($marcas as $marca)
                                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <select name="campana_select" id="campana_select" class="form-control" >
                            <option value="">Seleccionar Campa&ntilde;a</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <input type="text" name="campana_input" id="campana_input" class="form-control" style="" placeholder="Ingresar campa&ntilde;a especifica">
                    </div>
                    <div class="form-group col-sm-3 report-button"><br>
                        <button type="submit" class="btn btn-primary rep-btn" style=""><i class="fa fa-download"></i>   Generar Reporte y Descargar</button>
                    </div>
                </form>
                <div class="col-md-12 hide" id="progreso">
                    <br>
                    <br>
                    <p>
                        Generando reporte...
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#marca_id').change(function(e){
                $.getJSON( "{{ route('detallecampana.obtenerCampanas') }}", {marca_id: $(this).val() }, function( data ) {
                    var items = '<option value="">Seleccionar Campa&ntilde;a</option>';
                    $.each( data[0], function( key, val ) {
                         items += '<option value="'+val+'">'+val+'</option>';
                    });
                    $('#campana_select').html(items);
                });
            });
        });
    </script>
@endsection

