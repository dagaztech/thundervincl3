@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Gesti&oacute;n de Usuarios</h1>
        <div class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('usersman.create') !!}">Crear Nuevo Usuario</a>
        </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('users.table')
            </div>
        </div>
    </div>
@endsection

