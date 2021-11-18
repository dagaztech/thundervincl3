@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Panel de Notificaciones</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('notificaciones.table')
            </div>
        </div>
    </div>
@endsection

