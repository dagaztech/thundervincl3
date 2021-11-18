@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Máster de Campañas</h1>
        <div class="pull-right">
		<a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px; margin-left:5px;" href="{!! route('vinsman.create') !!}">Crear Nueva Campaña</a>
        </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('vins.table')
            </div>
        </div>
    </div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
        $(document).ready(function () {
           $(document).on('click', 'a.btn-default', function (event) {
                currentUrl = $(this).attr("href")
                $(this).attr("href", currentUrl.replace("vins", "vinsman"))
            });

           $(document).on('click', 'a.btn-danger', function (event) {
                currentUrl = $(this).attr("href")
                $(this).attr("href", currentUrl.replace("vins", "vinsman"))
            });

           $(document).on('click', 'a.btn-success', function (event) {
                currentUrl = $(this).attr("href")
                $(this).attr("href", currentUrl.replace("vins", "vinsman"))
            });

           $(document).on('submit', 'form', function (event) {
                currentUrl = $(this).attr("action")
                $(this).attr("action", currentUrl.replace("vins", "vinsman"))
            });
        });

    
</script>
