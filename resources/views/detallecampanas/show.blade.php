@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Detalle de Campa&ntilde;as
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('detallecampanas.show_fields')
                    <a href="{!! route('vins.marca', 1) !!}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
