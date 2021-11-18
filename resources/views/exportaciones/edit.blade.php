@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Exportaciones
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($exportacion, ['route' => ['exportaciones.update', $exportacion->id], 'method' => 'patch']) !!}

                        @include('exportaciones.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection