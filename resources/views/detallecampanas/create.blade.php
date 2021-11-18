@extends('layouts.app')

@section('content')
    <section class="content-header new-camp">
        <h1>
            Crear Nuevo Detalle de Campa&ntilde;a
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'detallecampanas.store']) !!}

                        @include('detallecampanas.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
