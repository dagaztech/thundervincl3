<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $detallecampana->id !!}</p>
</div>

<!-- Vines Field -->
<div class="form-group">
    {!! Form::label('vin', 'VINs:') !!}
    <p>{!! $detallecampana->vin !!}</p>
</div>

<!-- Marca Field -->
<div class="form-group">
    {!! Form::label('marca_id', 'Marca:') !!}
    <p>{!! $detallecampana->marca->nombre !!}</p>
</div>

<!-- Campana Field -->
<div class="form-group">
    {!! Form::label('campana', 'Campana:') !!}
    <p>{!! $detallecampana->campana !!}</p>
</div>

<!-- Vendedor Field -->
<div class="form-group">
    {!! Form::label('vendedor', 'Vendedor:') !!}
    <p>{!! $detallecampana->vendedor !!}</p>
</div>

<!-- Parts Field -->
<div class="form-group">
    {!! Form::label('parts', 'Partes:') !!}
    <p>{!! $detallecampana->parts !!}</p>
</div>

<!-- Count Field -->
<div class="form-group">
    {!! Form::label('count', 'Cuenta:') !!}
    <p>{!! $detallecampana->count !!}</p>
</div>

<!-- Atendido Field -->
<div class="form-group">
    {!! Form::label('labour', 'Labor:') !!}
    <p>{!! $detallecampana->labour !!}</p>
</div>

<!-- Fecha_ejecucion_campana Field -->
<div class="form-group">
    {!! Form::label('fecha_ejecucion_campana', 'Fecha de ejecución:') !!}
    <p>{!! $detallecampana->fecha_ejecucion_campana !!}</p>
</div>

<!-- Importar_dealer Field -->
<div class="form-group">
    {!! Form::label('importer_dealer', 'Nombre:') !!}
    <p>{!! $detallecampana->importer_dealer !!}</p>
</div>

<!-- Dealer_que_ejecuta_campana Field -->
<div class="form-group">
    {!! Form::label('dealer_que_ejecuta_campana', 'Dealer que ejecuta campaña:') !!}
    <p>{!! $detallecampana->dealer_que_ejecuta_campana !!}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Creado por:') !!}
    <p>{!! $detallecampana->created_by !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Eliminado en:') !!}
    <p>{!! $detallecampana->deleted_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado en:') !!}
    <p>{!! $detallecampana->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Actualizado en:') !!}
    <p>{!! $detallecampana->updated_at !!}</p>
</div>

