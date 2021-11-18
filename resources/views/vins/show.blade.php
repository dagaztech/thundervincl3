@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Informaci&oacute;n de Campa&ntilde;a {{ $vin->campana }}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding: 20px">
                    @include('vins.show_fields')
                    <a href="{!! route('vins.index') !!}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
