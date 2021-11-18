@extends('layouts.app')

@section('css')
    @include('layouts.datatables_css')
@endsection

@section('content')

    <section class="content-header">

        @if (isset($marca))

            <h1 class="pull-left">{{ strtoupper($marca->nombre) }}</h1>

        @else

            <h1 class="pull-left">Historial de Campa&ntilde;as</h1>

        @endif

        <div class="pull-right">

         </div>

    </section>

    <div class="content">

        <div class="clearfix"></div>



        @include('flash::message')



        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-header ui-sortable-handle with-border">
            <h3 class="box-title"><i class="fa fa-line-chart"></i> Todas las Campañas Consultadas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-responsive camp-table">
                    <thead>
                    <th>Campaña</th>
                    <th>Total de Afectados</th>
                    <th>Total de vines atendidos</th>
                    <th>Consultas Efectivas</th>
                    <th>Efectividad de Cumplimiento</th>
                    <th>Efectividad de consulta</th>
                    <th>Número de Consultas web</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach ($campanas_mas_consultadas as $campana)
                        <tr>
                            <td>{{ $campana->campana}}</td>
                            <td class="text-center">{{ $campana->total_afectados }}</td>
                            <td class="text-center">{{ $campana->total_atendidos }}</td>
                            <td class="text-center">{{ $campana->consultas_efectivas }}</td>
                            <td class="text-center">{{ round(($campana->total_atendidos/$campana->total_afectados)*100,2) }}%</td>
                            <td class="text-center">{{ round(($campana->consultas_efectivas/$campana->total_afectados)*100,2) }}%</td>
                            <td class="text-center">{{ $campana->consultas_web }}</td>
                            <td>
                                <a href="{{ route('vins.vistaDetalle', $campana->campana) }}">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>

@endsection
@section('scripts')
    @include('layouts.datatables_js')
    <script type="text/javascript">
		$(function(){
			$('.table').DataTable({
				processing: true,
				searching: true,
				order: [[ 3, "desc" ]],
				"language": {
				  "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
				}
			}); 
		})
	</script>

@endsection





