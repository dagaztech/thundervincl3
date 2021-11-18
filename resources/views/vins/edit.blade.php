@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Editar M&aacute;ster de Campa&ntilde;as
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row" style="margin-left:1px;">
				<div class="panel panel-default col-xs-8 lefty">
					<div class="panel-body">
						<strong>INSTRUCCIONES:</strong>
						<ul class="note-list">
							<li>
								Recuerde que al modificar este archivo afectará el cotejamiento de la base de datos y los resultados respectivos para que se consulten.
							</li>
							<li>
								Edite este panel cuando se trate de actualizar todas las características de una campaña, pues el cambio se verá en todos los VINes asociados.
							</li>
							<li>
								Para actualizar VINes individuales, utilice mejor la opción "Actualización de Campañas".
							</li>
							<li>
								Por favor recuerde que para no tener fallos en la carga de datos, completar todos los campos de este formulario al crear o editar la campaña.
							</li>
						</ul>
					</div>
				</div>
			</div>
               <div class="row">
                   {!! Form::model($vin, ['route' => ['vins.update', $vin->id], 'method' => 'patch']) !!}

                        @include('vins.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@section('scripts')
	<script>
		$(document).ready(function () {

			//creacion de inputs adicionales para lineas afectadas por campanas y modelos vehiculos afectados
			$('#add-lineas').click(function (e) { 
				e.preventDefault();
				
				var input_lineas = $("<input/>", {
										type: "text",
										class: "form-control  lineas_afectadas_por_campanas",
										id: "lineas_afectadas_por_campanas[]",		
										name: "lineas_afectadas_por_campanas[]"		
									});
				var input_modelos = $("<input/>", {
										type: "text",
										class: "form-control modelos_vehiculos_afectados",
										id: "modelos_vehiculos_afectados[]",	
										name: "modelos_vehiculos_afectados[]"	
									});

				$('#lineas-afectadas').append(input_lineas);
				$('#modelos-afectados').append(input_modelos);
			});
				//eliminacion de inputs adicionales para lineas afectadas por campanas y modelos vehiculos afectados
			$('#rm-lineas').click(function (e) { 
				e.preventDefault();
                $('.modelos_vehiculos_afectados').last().remove();
                $('.lineas_afectadas_por_campanas').last().remove();
                console.log($('#lineas_afectadas_por_campanas').last().val())
			});
		});
	</script>
@endsection