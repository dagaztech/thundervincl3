
<li class="{{ Request::is('admin') ? 'active' : '' }}">

    <a href="{!! url('/admin') !!}"><i class="fa fa-home"></i><span>Inicio</span></i></a>

</li>
<li class="{{ Request::is('admin/panel/marca/*') ? 'active' : '' }}">


    <a href="{!! route('vins.index') !!}"><i class="fa fa-list"></i><span>Administrar por marca</span> <i class="fa fa-angle-down "></i></a>
   
    <ul class="treeview-menu">
	 	@if (!Auth::user()->hasRole('wolks') && !Auth::user()->hasRole('man')) 

		<li class="{{ Request::is('admin/panel/marca/1') ? 'active' : '' }}">

			<a href="{{route('panel.marca', 1)}}">

					<i class="fa fa-car"></i>

			AUDI   (A)

			</a>

		</li>

		<li class="{{ Request::is('admin/panel/marca/2') ? 'active' : '' }}">

			<a href="{{route('panel.marca', 2)}}">

					<i class="fa fa-car"></i>

			VOLKSWAGEN PKW   (V)

			</a>

		</li>

		<li class="{{ Request::is('admin/panel/marca/3') ? 'active' : '' }}">

			<a href="{{route('panel.marca', 3)}}">

					<i class="fa fa-car"></i>

			VOLKSWAGEN LCV   (L)

			</a>

		</li>


		<li class="{{ Request::is('admin/panel/marca/5') ? 'active' : '' }}">

			<a href="{{route('panel.marca', 5)}}">

					<i class="fa fa-car"></i>

			SEAT   (S)

			</a>

		</li>

		<li class="{{ Request::is('admin/panel/marca/6') ? 'active' : '' }}">

			<a href="{{route('panel.marca', 6)}}">

					<i class="fa fa-car"></i>

			ŠKODA   (C)

			</a>
			
		</li>
 		@endif

	 	@if (Auth::user()->hasRole('wolks')) 
			<li class="{{ Request::is('admin/panel/marca/4') ? 'active' : '' }}">

				<a href="{{route('panel.marca', 4)}}">

						<i class="fa fa-car"></i>

				VOLKSWAGEN T&B   (T)

				</a>
			</li>

 		@endif

		
		 @if (Auth::user()->hasRole('man')) 
			<li class="{{ Request::is('admin/panel/marca/7') ? 'active' : '' }}">

				<a href="{{route('panel.marca', 7)}}">

						<i class="fa fa-car"></i>

			     MAN (M)

				</a>

			</li>
 		@endif

		

	</ul>

</li>

<li class="{{ Request::is('admin/vins') ? 'active' : '' }}">

 	@if (Auth::user()->hasRole('wolks')) 
    	<a href="{!! route('vinsvokls.index') !!}"><i class="fa fa-edit"></i><span>Máster de Campañas</span></a>
	@endif

	@if (Auth::user()->hasRole('man')) 
    	<a href="{!! route('vinsman.index') !!}"><i class="fa fa-edit"></i><span>Máster de Campañas</span></a>
	@endif

 	@if (!Auth::user()->hasRole('wolks') && !Auth::user()->hasRole('man')) 
    	<a href="{!! route('vins.index') !!}"><i class="fa fa-edit"></i><span>Máster de Campañas</span></a>
	@endif


</li>

<li class="{{ Request::is('admin/vines/listaVins') ? 'active' : '' }}">

	@if (Auth::user()->hasRole('wolks')) 
    	<a href="{!! route('vinsvokls.historial_busquedas') !!}"><i class="fa fa-eye"></i><span>Consulta de Vines</span></a>

	@endif

	@if (Auth::user()->hasRole('man')) 
    	<a href="{!! route('vinsman.historial_busquedas') !!}"><i class="fa fa-eye"></i><span>Consulta de Vines</span></a>
	@endif

 	@if (!Auth::user()->hasRole('wolks') && !Auth::user()->hasRole('man')) 
    	<a href="{!! route('vines.listaVins') !!}"><i class="fa fa-eye"></i><span>Consulta de Vines</span></a>
	@endif

</li>

<li class="{{ Request::is('admin/vines/upload') ? 'active' : '' }}">

    <a href="{!! route('vines.upload') !!}"><i class="fa fa fa-upload"></i><span>Actualización de Campañas</span></a>

</li>

<li class="{{ Request::is('admin/users*') ? 'active' : '' }}">

    <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>Gestión de Usuarios</span></a>

</li>

<!--li class="{{ Request::is('admin/exportaciones*') ? 'active' : '' }}">

    <a href="{!! route('exportaciones.index') !!}"><i class="fa fa-download"></i><span>Exportación B.I.</span></a>

</li
<li class="{{ Request::is('admin/logImportaciones*') ? 'active' : '' }}">

    <a href="{!! route('logImportaciones.index') !!}"><i class="fa fa-exclamation-circle"></i><span>Log de Errores de Exportación</span></a>

</li>
-->


<li class="{{ Request::is('admin/log') ? 'active' : '' }}">

    <a href="{!! route('log.index') !!}"><i class="fa fa-stack-overflow"></i><span>Consulta de Logs</span></a>

</li>

<li class="{{ Request::is('admin/detallecampanas') ? 'active' : '' }}">

	<a href="{{route('detallecampanas.index')}}">

			<i class="fa fa-history" aria-hidden="true"></i><span>Generación de Históricos</span>

	</a>

</li>

<li class="{{ Request::is('admin/tutorial') ? 'active' : '' }}">

	<a href="{{route('vins.tutorial')}}">

			<i class="fa fa-file" aria-hidden="true"></i><span>Tutorial de Uso</span>

	</a>

</li>
