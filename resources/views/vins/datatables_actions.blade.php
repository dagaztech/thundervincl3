{!! Form::open(['route' => ['vins.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('vins.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('¿Estás seguro?')"
    ]) !!}
    @if ($estado == 1)
        <a href="{{ route('vins.desactivar', $id) }}" class='btn btn-danger btn-xs'>Desactivar</a>
    @else
        <a href="{{ route('vins.activar', $id) }}" class='btn btn-success btn-xs'>Activar</a>
    @endif
</div>
{!! Form::close() !!}
