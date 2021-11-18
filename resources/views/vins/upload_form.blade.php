@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/fileupload/css/jquery.fileupload.css') }}">
@endsection
@section('content')

<section class="content-header">
	<h1 class="pull-left singleTitle">Actualización de Campañas</h1>
	
</section>
<div class="content">
	<div class="clearfix"></div>

	@include('flash::message')

	<div class="clearfix"></div>
	<div class="box box-primary">
		<div class="box-body">
			<div class="row" style="margin-left:1px;">
				<div class="panel panel-default col-xs-8 lefty">
					<div class="panel-body">
						<strong>INSTRUCCIONES:</strong>
						<ul class="note-list">
							<li>
								Esta herramienta agiliza la carga rápida de Campañas de Servicio actualizando la base de datos de una marca única, para que el cliente solo pueda acceder a campañas activas.
							</li>
							<li>
								Si desea actualizar una campaña, seleccione la marca deseada y haga clic en el botón “Cargar y Actualizar Campaña” para subir el nuevo archivo.
							</li>
						</ul>
					</div>
				</div>
			</div>

			<form id="fileupload" class="form-inline" enctype="multipart/form-data">
				{{ csrf_field() }}

				{!! Form::label('marca_id', 'Actualizar Campa&ntilde;a de Marca:') !!}
				<br>
				{!! Form::select('marca_id', $marcas->pluck('nombre', 'id'),null, ['class'=> 'form-control']) !!}

				<span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i> <span>Cargar y Actualizar Campaña</span> <!-- The file input field used as target for the file upload widget -->
					<input type="file"  name="files" multiple>
				</span>
			</form>
			<br>
			<br>
			<p>
				Carga de archivo:
			</p>
			<!-- The global progress bar -->
			<div id="progress" class="progress">
				<div class="progress-bar progress-bar-success"></div>
			</div>
			<!-- The container for the uploaded files -->
			<div id="files" class="files"></div>
			<br>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('vendor/fileupload/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('vendor/fileupload/js/jquery.fileupload.js') }}"></script>
<script src="{{ asset('vendor/fileupload/js/jquery.fileupload-process.js') }}"></script>
<script src="{{ asset('vendor/fileupload/js/jquery.fileupload-validate.js') }}"></script>
<script src="{{ asset('vendor/fileupload/js/jquery.iframe-transport.js') }}"></script>
<script>
	$(function() {
		'use strict';
		// Change this to the location of your server-side upload handler:
		var url = "{{ route('vins.detalle.store.file') }}",
		    uploadButton = $('<button/>').addClass('btn btn-primary').prop('disabled', true).text('Procesando...').on('click', function() {
			var $this = $(this),
			    data = $this.data();
			$this.off('click').text('Cancelar').append('<i class="fa fa-spinner fa-spin"></i>').on('click', function() {
				$this.remove();
				data.abort();
			});
			data.submit().always(function() {
				$this.remove();
			});
		});
		$('#fileupload').fileupload({
			url : url,
			dataType : 'json',
			autoUpload : false,
			acceptFileTypes : /(\.|\/)(xlsx|xls|txt|ods)$/i,
			maxFileSize : 9990000,
			// Enable image resizing, except for Android and Opera,
			// which actually support image resizing, but fail to
			// send Blob objects via XHR requests:
			disableImageResize : /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
			previewMaxWidth : 100,
			previewMaxHeight : 100,
			previewCrop : true
		}).on('fileuploadadd', function(e, data) {
			data.context = $('<div/>').appendTo('#files');
			$.each(data.files, function(index, file) {
				var node = $('<p/>').append($('<span/>').text(file.name));
				if (!index) {
					node.append('<br>').append(uploadButton.clone(true).data(data));
				}
				node.appendTo(data.context);
			});
		}).on('fileuploadprocessalways', function(e, data) {
			var index = data.index,
			    file = data.files[index],
			    node = $(data.context.children()[index]);
			if (file.preview) {
				node.prepend('<br>').prepend(file.preview);
			}
			if (file.error) {
				node.append('<br>').append($('<span class="text-danger"/>').text('Extension de archivo no válida'));
			}
			if (index + 1 === data.files.length) {
				data.context.find('button').text('Subir archivo').prop('disabled', !!data.files.error);
			}
		}).on('fileuploadprogressall', function(e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress .progress-bar').css('width', progress + '%');
		}).on('fileuploaddone', function(e, data) {
			
			//data = data.replaceAll("#", "")


			$.each(data.files, function(index) {
				console.log(index, data)

				var success = $('<span class="text-success"/>').text('Campañas actualizadas exitosamente!');
				var results = $('<span class="text-success"/>').text(data.result.files.results + ' Registros');
				var failed = $('<span class="text-danger"/>').text('Campañas sin actualizar');
				var rejects = $('<span class="text-danger"/>').text(data.result.files.rejects + ' Registros');
				$(data.context.children()[index]).append('<br>').append(success).append('<br>').append(results).append('<br>').append(failed).append('<br>').append(rejects);
			});
		}).on('fileuploadfail', function(e, data) {

			//data = data.replaceAll("#", "")
			var datastring = data.jqXHR.responseText.replaceAll("#", "")
			var result = JSON.parse(datastring)
			console.log(result)

			$.each(data.files, function(index) {
				console.log(index, data)

				var success = $('<span class="text-success"/>').text('Campañas actualizadas exitosamente!');
				var results = $('<span class="text-success"/>').text(result.files.results + ' Registros');
				var failed = $('<span class="text-danger"/>').text('Campañas sin actualizar');
				var rejects = $('<span class="text-danger"/>').text(result.files.rejects + ' Registros');
				$(data.context.children()[index]).append('<br>').append(success).append('<br>').append(results).append('<br>').append(failed).append('<br>').append(rejects);
			});
			//$.each(data.files, function(index) {
				//var error = $('<span class="text-danger"/>').text('Error al subir archivo. Favor verificar y/o crear nueva campaña');
				//$(data.context.children()[index]).append('<br>').append(error);
			//});
		}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
	}); 
</script>
@endsection
