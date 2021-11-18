@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Detalle de Campa&ntilde;as
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($detallecampana, ['route' => ['detallecampanas.update', $detallecampana->id], 'method' => 'patch']) !!}

                        @include('detallecampanas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection