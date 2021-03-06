@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Log de Errores de Importación</h1>
        <div class="pull-right">
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px; margin-left:5px;" href="{!! route('vins.importar') !!}">Importar manualmente archivo errores</a>
        </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('log_importaciones.table')
            </div>
        </div>
    </div>
@endsection

