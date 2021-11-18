@extends('layouts.app')
@section('css')
@include('layouts.datatables_css')
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Información para {{$marca->nombre}}
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Panel de Control {{ $marca->nombre }}</li>
   </ol>
</section>
@include('flash::message')
<section class="content">
   <!-- Info boxes -->
   <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-12">
         <div class="small-box bg-aqua">
            <div class="inner">
               <h3>{{ $consultas_marca ? $consultas_marca['consultas'] : 0 }}</h3>
               <p>Total de Consultas</p>
            </div>
            <div class="icon">
               <i class="ion ion-ios-timer"></i>
            </div>
            <a href="#" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
            <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-4 col-xs-12">
         <div class="small-box bg-red">
            <div class="inner">
               <h3>{{ $consultas_efectivas ? $consultas_efectivas['consultas'] : 0 }}</h3>
               <p>Consultas con Campaña Asociada</p>
            </div>
            <div class="icon">
               <i class="ion ion-thumbsup"></i>
            </div>
            <a href="#" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
            <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-4 col-xs-12">
         <div class="small-box bg-green">
            <div class="inner">
               <h3>{{ round($efectividad_consultas) }} %</h3>
               <p>Efectividad de Consultas</p>
            </div>
            <div class="icon">
               <i class="fa fa-dashboard"></i> 
            </div>
            <a href="{!! route('users.index') !!}" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
            <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
      </div>
            <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>
      <!-- /.col -->
      <!-- /.col -->
   </div>
   <!-- /.row -->
   <div class="row">
      <div class="col-md-9">
         <!-- PRODUCT LIST -->
         <div class="box box-primary">
            <div class="box-header ui-sortable-handle with-border">
               <h3 class="box-title"><i class="fa fa-line-chart"></i>  Top 10: Campañas con más consultas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <table id="tabla_consultas" class="table table-responsive">
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
            <!-- /.box-body -->
            <div class="box-footer text-right">
               <a href="{{ route('vins.marca', $marca->id) }}" class="btn btn-primary">Ver todas las campañas de esta marca</a>
            </div>
            <!-- /.box-footer -->
         </div>
         <!-- /.box -->
      </div>
      <div class="col-md-2 panel-info">
         <div class="row">
            <canvas id="consultas-mes-chart" height="300"></canvas>
          
            <a href="{!! route('vins.create') !!}" class="btn btn-primary new-camp hideshowbtns" style="width:100%;"><i class="fa fa-plus"></i>  Crear nueva Campaña</a>
          
   @if (Auth::user()->hasRole('wolks')) 
      <a href="{!! route('vinsvokls.create') !!}" class="btn btn-primary new-camp"><i class="fa fa-plus"></i>  Crear nueva Campaña</a>
   @endif
   @if (Auth::user()->hasRole('man')) 
      <a href="{!! route('vinsman.create') !!}" class="btn btn-primary new-camp"><i class="fa fa-plus"></i>  Crear nueva Campaña</a>
   @endif  
            
         </div>
      </div>
   </div>
</section>
@endsection
@section('scripts')
@include('layouts.datatables_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
<script>
  $(function(){
   /*$('#tabla_consultas').DataTable({
 processing: false,
   searching: true,
   order: [[ 3, "desc" ]],
   "language": {
   "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
   }
   });**/
   
       function aleatorio(inferior,superior){ 
   
   
   
       numPosibilidades = superior - inferior 
   
   
   
       aleat = Math.random() * numPosibilidades 
   
   
   
       aleat = Math.floor(aleat) 
   
   
   
       return parseInt(inferior) + aleat 
   
   
   
       }
   
   
   
       function dame_color_aleatorio(){ 
   
   
   
           hexadecimal = new Array("0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F") 
   
   
   
           color_aleatorio = "#"; 
   
   
   
           for (i=0;i<6;i++){ 
   
   
   
           posarray = aleatorio(0,hexadecimal.length) 
   
   
   
           color_aleatorio += hexadecimal[posarray] 
   
   
   
           } 
   
   
   
           return color_aleatorio 
   
   
   
       }
   
   
   
       var data = {
   
   
   
           labels:[],
   
   
   
           datasets:[{
   
               
   
               label: "{{$marca->nombre}}",
   
   
   
               backgroundColor: "#6ba52e",
   
   
   
               borderColor: "#85CE36 ",
   
   
   
               data: []
   
           }]
   
   
   
       };
   
       
   
       @if(sizeof($consultas_por_mes) > 0)
   
       
   
           @foreach($consultas_por_mes as $consulta)
   
   
   
               data.labels.push("{{$consulta['mes']}}");
   
   
   
               data.datasets[0].data.push("{{$consulta['total_consultas']}}");
   
   
   
           @endforeach
   
   
   
       @endif
   
   
   
       var options = {
   
   responsive: true,
   
   title: {
   
   display: true,
   
   text: 'Consultas por Mes',
   
   },
   
   tooltips: {
   
   mode: 'index',
   
   intersect: false,
   
   },
   
   hover: {
   
   mode: 'nearest',
   
   intersect: true
   
   },
   
   scales: {
   
   xAxes: [{
   
   display: true,
   
   scaleLabel: {
   
   display: true,
   
   labelString: ''
   
   }
   
   }],
   
   yAxes: [{
   
   display: true,
   
   scaleLabel: {
   
   display: true,
   
   labelString: ''
   
   }
   
   }]
   
   }
   
   }
   
   
   
       var ctx = document.getElementById("consultas-mes-chart").getContext("2d");
   
   
   
           var myBarChart = new Chart(ctx, {
   
   
   
           type: 'line',
   
   
   
           data: data,
   
   
   
           options: options
   
   
   
       });
   
   })
   
</script>
@endsection