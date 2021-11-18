<!-- Marca Field -->
<div class="form-group col-sm-6">
    {!! Form::label('marca_id', 'Marca:') !!}
    {!! Form::select('marca_id', $marcas->pluck('nombre', 'id'),null, ['class'=> 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Marca']) !!}
</div>

<!-- Vin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vin', 'Ingresar VIN para esta campa&ntilde;a:') !!}
    {!! Form::text('vin', null, array('class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'VIN') ) !!}
</div>

<!-- Campana Field -->
<div class="form-group col-sm-6">
    {!! Form::label('campana', 'C&oacute;digo de Campa&ntilde;a:') !!}
    {!! Form::text('campana', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'C&oacute;digo de Campa&ntilde;a']) !!}
</div>

<!-- Fecha_ejecucion_campana Field-->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_ejecucion_campana', 'Fecha de ejecuci&oacute;n de campa&ntilde;a:') !!}
    {!! Form::text('fecha_ejecucion_campana', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Fecha']) !!}
</div> 

<!-- Importer_dealer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('importer_dealer', 'Importador:') !!}
    {!! Form::text('importer_dealer', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Importador']) !!}
</div>

<!-- Vendedor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vendedor', 'Vendedor:') !!}
    {!! Form::text('vendedor', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Vendedor']) !!}
</div>

<!-- Labour Field -->
<div class="form-group col-sm-6">
    {!! Form::label('labour', 'Labor:') !!}
    {!! Form::text('labour', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Labor']) !!}
</div>

<!-- Parts Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parts', 'Partes:') !!}
    {!! Form::text('parts', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Partes']) !!}
</div>

<!-- Dealer_que_ejecuta_campana Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dealer_que_ejecuta_campana', 'Dealer que ejecuta campa&ntilde;a:') !!}
    {!! Form::text('dealer_que_ejecuta_campana', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Dealer']) !!}
</div>

<!-- Fecha_ejecucion_campana Field-->
<div class="form-group col-sm-6">
    {!! Form::label('importer_ejecuta', 'Importador que ejecuta campa&ntilde;a:') !!}
    {!! Form::text('importer_ejecuta', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Importador']) !!}
</div> 

<!-- Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('count', 'Cuenta:') !!}
    {!! Form::text('count', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Cuenta']) !!}
</div>

<!-- Criterio Field-->
<div class="form-group col-sm-6">
    {!! Form::label('criterio', 'Criterio:') !!}
    {!! Form::text('criterio', null, ['class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Criterio']) !!}
</div> 

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Crear / Actualizar Campa&ntilde;a', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('vins.marca', 1) !!}" class="btn btn-default">Cancelar</a>
</div>

