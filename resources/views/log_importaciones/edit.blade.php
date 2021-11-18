@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Log Importacion
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($logImportacion, ['route' => ['logImportaciones.update', $logImportacion->id], 'method' => 'patch']) !!}

                        @include('log_importaciones.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection