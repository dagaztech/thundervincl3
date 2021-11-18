<!-- Marca Field -->

<div class="form-group col-sm-6">

    {!! Form::label('marca_id', 'Marca:') !!}

    {!! Form::select('marca_id', $marcas->pluck('nombre', 'id'),null, ['class'=> 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Marca']) !!}

</div>



<!-- Campana Field -->

<div class="form-group col-sm-6">

    {!! Form::label('campana', 'C&oacute;digo de Campa&ntilde;a:') !!}

    {!! Form::text('campana', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'C&oacute;digo de Campa&ntilde;a']) !!}

</div>

@if(!isset($vin->id))

<!-- Vines Field -->

<div class="form-group col-sm-6">

    {!! Form::label('vines', 'Cargar VINes para esta campa&ntilde;a:') !!}

    {!! Form::file('vines') !!}

</div> 

@endif



<!-- nombre Field -->

<div class="form-group col-sm-6">

    {!! Form::label('nombre', 'Nombre de Campa&ntilde;a:') !!}

    {!! Form::text('nombre', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Nombre de Campa&ntilde;a']) !!}

</div>



<!-- Fehca_inicio_campana Field-->



<div class="form-group col-sm-6">



    {!! Form::label('fecha_inicio_campana', 'Fecha de Inicio de Campa&ntilde;a:') !!}



    {!! Form::date('fecha_inicio_campana', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Fecha de Inicio de Campa&ntilde;a']) !!}



</div> 







<!-- lineas_afectadas_por_campanas Field -->



<div class="form-group col-sm-3" id="lineas-afectadas">

    {!! Form::label('lineas_afectadas_por_campanas[]', 'Líneas afectadas por Campa&ntilde;a:') !!}

    @if (isset($lineas) && is_array($lineas))
        
        @foreach ($lineas as $linea)
        {!! Form::text('lineas_afectadas_por_campanas[]', $linea, ['class' => 'form-control lineas_afectadas_por_campanas', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Líneas afectadas por Campa&ntilde;a']) !!}

        
        @endforeach
    @else
        {!! Form::text('lineas_afectadas_por_campanas[0]', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Líneas afectadas por Campa&ntilde;a']) !!}
    @endif
    
</div>

<!-- Modelos_vehiculos_afectados Field -->

<div class="form-group col-sm-3" id="modelos-afectados">

    {!! Form::label('modelos_vehiculos_afectados[]', 'Modelos de vehiculos afectados:') !!}
    <button class="btn btn-default add-lines" id="add-lineas">
        <i class="fa fa-plus"></i>
    </button>
    <button class="btn btn-default rm-lines" id="rm-lineas">
        <i class="fa fa-minus"></i>
    </button>

    @if (isset($modelos) && is_array($modelos))

        @foreach($modelos as $modelo)
            {!! Form::text('modelos_vehiculos_afectados[]', $modelo, ['class' => 'form-control modelos_vehiculos_afectados', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Modelos de vehiculos afectados']) !!}
       
        @endforeach
    @else   
        {!! Form::text('modelos_vehiculos_afectados[0]', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Modelos de vehiculos afectados']) !!}
    @endif

</div>



<!-- Atendido Field-->

<div class="form-group col-sm-6">

    {!! Form::label('atendido', 'Cierre Campa&ntilde;a:') !!}

    {!! Form::date('atendido', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Atendido']) !!}

</div> 



<!-- Estado Field -->

<div class="form-group col-sm-6">

    {!! Form::label('estado', 'Estado:') !!}

    {!! Form::select('estado', ['1' => 'Activo', '0' => 'Inactivo'], null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Estado']); !!}

</div>



<!-- descripcion Field -->

<div class="form-group col-sm-6 descrip-camps">

    {!! Form::label('descripcion', 'Descripción:') !!}

    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Descripción']) !!}

</div>





<!-- descripcion Field -->

<div class="form-group col-sm-6 descrip-camps">

    {!! Form::label('info_adicional', 'Información Adicional:') !!}

    {!! Form::textarea('info_adicional', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Informacion Adicional']) !!}

</div>



<!-- Submit Field -->

<div class="form-group col-sm-12">

    {!! Form::submit('Crear / Actualizar Campa&ntilde;a', ['class' => 'btn btn-primary']) !!}

    <a href="{!! route('vins.index') !!}" class="btn btn-default">Cancelar</a>

</div>



<!-- Vendedor Field

<div class="form-group col-sm-6">

    {!! Form::label('vendedor', 'Vendedor:') !!}

    {!! Form::text('vendedor', null, ['class' => 'form-control']) !!}

</div> -->



<!-- Ano Field

<div class="form-group col-sm-6">

    {!! Form::label('ano', 'A���o:') !!}

    {!! Form::text('ano', null, ['class' => 'form-control']) !!}

</div> -->



<!-- Modelo Field

<div class="form-group col-sm-6">

    {!! Form::label('modelo', 'Modelo:') !!}

    {!! Form::text('modelo', null, ['class' => 'form-control']) !!}

</div> -->



<!-- Ciudad Field

<div class="form-group col-sm-6">

    {!! Form::label('ciudad', 'Ciudad:') !!}

    {!! Form::text('ciudad', null, ['class' => 'form-control']) !!}

</div> -->

