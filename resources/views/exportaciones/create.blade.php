@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Exportación
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'exportaciones.store']) !!}

                        @include('exportaciones.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
