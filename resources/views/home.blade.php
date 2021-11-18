@extends('layouts.app')

@section('content')

   <!-- Content Header (Page header) -->

    <section class="content-header">

     <h1 class="hideshowbtns">Panel de Control de ThunderVIN<small>Versión 3.0</small></h1>
      
      
     @if (Auth::user()->hasRole('wolks')) 
     <h1>Panel de Control de ThunderVIN | Volkswagen T&B <small>Versión 3.1</small></h1>
     @endif
     
     @if (Auth::user()->hasRole('man')) 
     <h1>Panel de Control de ThunderVIN | MAN <small>Versión 3.1</small></h1>
     @endif

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

        <li class="active">Panel de Control</li>

      </ol>

    </section>



    @include('flash::message')

<section class="content">

      <!-- Info boxes -->

      <div class="row">

        <div class="col-md-6 col-sm-6 col-xs-12">

          <div class="small-box bg-aqua" style="height: 135px;">

            <div class="inner">

              <h3>{{$consultas}}</h3>

              <p>Nuevas Consultas</p>

            </div>

            <div class="icon">

              <i class="fa fa-search"></i>

            </div>

            <!-- /.info-box-content -->

          </div>

          <!-- /.info-box -->

        </div>

        <!-- /.col -->

        <div class="col-md-6 col-sm-6 col-xs-12">

          <div class="small-box bg-red" style="height: 135px;">

            <div class="inner">

              <h3>{{$consultas1}}</h3>

              <p>Consultas Realizadas Último Mes</p>

            </div>

            <div class="icon">

              <i class="fa fa-thumbs-up"></i>

            </div>

            <!-- /.info-box-content -->

          </div>

          <!-- /.info-box -->

        </div>

        <!-- /.col -->


        <!-- fix for small devices only -->

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-6 col-sm-6 col-xs-12">

          <div class="small-box bg-green" style="height: 135px;">

            <div class="inner">

               @if($c_exitosas1 > 0)
                            <h3>{{round(($c_exitosas1/$consultas1)*100,2).'%'}}</h3>
                        @endif

              <p>Consultas Efectivas en Total</p>

            </div>

            <div class="icon">

              <i class="fa fa-check-circle"></i>

            </div>

            <!-- /.info-box-content -->

          </div>

          <!-- /.info-box -->

        </div>

        <!-- /.col -->

        <div class="col-md-6 col-sm-6 col-xs-12">

          <div class="small-box bg-yellow" style="height: 135px;">

            <div class="inner">
                 @if($c_exitosas1 > 0)

              <h3>{{round(($c_exitosas1/$consultas1)*100,2).'%'}}</h3>
               @endif

              <p>Consultas Efectivas Último Mes</p>

            </div>

            <div class="icon">

              <i class="fa fa-check-circle"></i>

            </div>

            <!-- /.info-box-content -->

          </div>

          <!-- /.info-box -->

        </div>

        <!-- /.col -->

      </div>
      <div class="row">
        <div class="col-md-12 text-left">
	  		<strong>Seleccione la marca que desea ver:</strong>
      	</div>
      </div>
      <!-- /.row -->

<div class="row">
   <div class="col-md-12 text-center">
      <div class="col-md-4 brand-buttons hideshowbtns">
         <a href="{{route('panel.marca', 5) }}" class="btn btn-lg btn-primary st-button" >Seat <i class="ion ion-model-s"></i></a>
      </div>
      <div class="col-md-4 brand-buttons hideshowbtns">
         <a href="{{route('panel.marca', 6) }}" class="btn btn-lg btn-primary sk-button" >Škoda <i class="ion ion-model-s"></i></a>
      </div>
      <div class="col-md-4 brand-buttons hideshowbtns">
         <a href="{{route('panel.marca', 1) }}" class="btn btn-lg btn-primary au-button">Audi <i class="ion ion-model-s"></i></a>
      </div>
      <div class="col-md-12 text-center" style="margin-top:20px;">
         <div class="col-md-4 brand-buttons hideshowbtns">
            <a href="{{route('panel.marca', 2) }}" class="btn btn-lg btn-primary vw-button" >Volkswagen PKW <i class="ion ion-model-s"></i></a>
         </div>
         <div class="col-md-4 brand-buttons hideshowbtns">
            <a href="{{route('panel.marca', 3) }}" class="btn btn-lg btn-primary vw-button">Volkswagen LCV <i class="ion ion-model-s"></i></a>
         </div>
         <!--BOTON TYB-->
         @if (Auth::user()->hasRole('wolks')) 
         <div class="col-md-4 brand-buttons hideshowbtnsvw">
            <a href="{{route('panel.marca', 4) }}" class="btn btn-lg btn-primary vw-button" >Volkswagen T&B <i class="ion ion-bus"></i></a>
         </div>
         @endif
         @if (Auth::user()->hasRole('man')) 
         <div class="col-md-4 brand-buttons hideshowbtnsmn">
            <a href="{{route('panel.marca', 7) }}" class="btn btn-lg btn-primary au-button" >MAN <i class="ion ion-bus"></i></a>
         </div>
         @endif
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-11 text-center btncampanawrapper hideshowbtns">
      <a href="{!! route('vins.create') !!}" class="btn btn-primary"><i class="fa fa-plus"></i>  Crear nueva Campaña</a>
   </div>
   @if (Auth::user()->hasRole('wolks')) 
     <div class="col-md-11 text-center btncampanawrapper">
      <a href="{!! route('vinsvokls.create') !!}" class="btn btn-primary"><i class="fa fa-plus"></i>  Crear nueva Campaña</a>
   </div>
   @endif
   @if (Auth::user()->hasRole('man')) 
     <div class="col-md-11 text-center btncampanawrapper">
      <a href="{!! route('vinsman.create') !!}" class="btn btn-primary"><i class="fa fa-plus"></i>  Crear nueva Campaña</a>
   </div>
   @endif
</div>

</section>

    
@endsection
