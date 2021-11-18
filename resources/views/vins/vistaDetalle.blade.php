@extends('layouts.app')



@section('content')

    <section class="content-header">

        <h1>

            Campa&ntilde;as más consultadas:Informaci&oacute;n de Campa&ntilde;a {{ $campana->campana }}

        </h1>

    </section>

    <div class="content">

        <div class="box box-primary">

            <div class="box-body">

                <div class="row">

                    <div class="col-md-4" style="border-right: 1px solid #f4f4f4;">

                        <p><Strong>Marca:</Strong></p>

                        <span>

                            @if (!empty($campana->marca))

                                

                                {{ $campana->marca->nombre }}

                            @else

                                No tiene

                            @endif  

                        </span><br><br>

                        

                        <p><Strong>Descripci&oacute;n:</Strong></p>

                        <span>

                            @if (!empty($campana->descripcion))

                                

                                {{ $campana->descripcion }}

                            @else

                                No tiene

                            @endif  

                        </span><br><br>

                        

                        <div class="col-md-6">

                            <p><Strong>Creado en:</Strong></p>

                            <span>{{ $campana->created_at }}</span><br>

                        </div>

                        <div class="col-md-6">

                            <p><Strong>Actualizado en:</Strong></p>

                            <span>{{ $campana->updated_at }}</span><br>

                        </div>

                        

                    </div>

                    <div class="col-md-4" style="border-right: 1px solid #f4f4f4;">

                        <p><Strong>Campa&ntilde;a:</Strong></p>

                        <span>

                            @if (!empty($campana->campana))

                                

                                {{ $campana->campana }}

                            @else

                                No tiene

                            @endif  

                        </span><br><br>

                        

                        <p><Strong>Total de afectados:</Strong></p>

                            <span>{{ $total_afectados }}</span><br>     

                        <br>

                        

                        <p><Strong>Consultas efectivas:</Strong></p>

                        <span>

                           

                            {{$consultas_efectivas}}

                        </span><br><br>

                        

                        <p><Strong>Efectividad de Consultas:</Strong></p>

                        <span>                  

                                {{ round($efectividad_consultas ) }} %

                        </span><br><br>
                        
                        
                        <p><Strong>Porcentaje Cumplimiento:</Strong></p>

                        <span>                  

                                {{ $porcentaje_cumplimiento }} %

                        </span><br><br>

                    </div>

                    <div class="col-md-4">

                        <p><Strong>Nombre:</Strong></p>

                        <span>

                            @if (!empty($campana->nombre))

                                

                                {{ $campana->nombre }}

                            @else

                                No tiene

                            @endif  

                        </span><br><br>



                        <p><Strong>Modelo:</Strong></p>

                        <span>

                            @if (!empty($campana->modelo))

                                

                                {{ $campana->modelo }}

                            @else

                                No tiene

                            @endif  

                        </span><br><br>

                        

                        <p><Strong>Año Model:</Strong></p>

                        <span>

                            @if (!empty($campana->ano))

                                

                                {{ $campana->ano }}

                            @else

                                No tiene

                            @endif  

                        </span><br><br>

                        

                        <p><Strong>Líneas:</Strong></p>

                        <span>

                            @if (!empty($campana->lineas_afectadas_por_campanas))

                                

                                {{ $campana->lineas_afectadas_por_campanas }}

                            @else

                                No tiene

                            @endif  

                        </span><br><br>

                    </div>

                </div>

                <div class="row pull-right" style="padding: 20px">

                    <a href="{{ route('detallecampanas.edit', $campana->id) }}" class="btn btn-sm btn-primary">Editar</a>

                    <a href="{!! route('panel.marca', $campana->marca_id) !!}" class="btn btn-lg btn-default">Regresar</a>

                </div>

            </div>

        </div>

    </div>

@endsection