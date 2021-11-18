@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/fileupload/css/jquery.fileupload.css') }}">
@endsection
@section('content')

<section class="content-header">
	<h1 class="pull-left singleTitle">Actualizar Máster de Campañas</h1>
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
								Recuerde que al modificar este archivo afectará el cotejamiento de la base de datos y los resultados respectivos para que se consulten. Por eso es importante que antes de sobreescribir este archivo, exporte el Máster actual y lo edite con la información que desea agregar.
							</li>
							<li>
								Solo actualice este documento cuando se trate de actualizar <strong>TODAS</strong> las campañas de una marca o de varias.
							</li>
							<li>
								Para crear o actualizar campañas de marcas individuales con cambios leves, utilice mejor la opción "Update de Campañas".
							</li>
							<li>
								Si aún desea actualizar el Máster, seleccione la marca desde las opciones de "Actualizar Campañas de Marca" y haga clic en el botón "Actualizar Máster" para sobreescribir esta base de datos en el sistema.
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

				<span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i> <span>Actualizar Máster</span> <!-- The file input field used as target for the file upload widget -->
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
		var url = "{{ route('vins.store.file') }}",
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
			maxFileSize : 999000,
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
				node.append('<br>').append($('<span class="text-danger"/>').text('Extensión de archivo no válida'));
			}
			if (index + 1 === data.files.length) {
				data.context.find('button').text('Subir archivo').prop('disabled', !!data.files.error);
			}
		}).on('fileuploadprogressall', function(e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress .progress-bar').css('width', progress + '%');
		}).on('fileuploaddone', function(e, data) {
			data = data.replaceAll("#", "")
			$.each(data.files, function(index) {
				console.log(index, data)
				var success = $('<span class="text-success"/>').text('¡Campañas actualizadas exitosamente!');
				var results = $('<span class="text-success"/>').text(data.result.files.results + ' Registros Guardados');

				$(data.context.children()[index]).append('<br>').append(success).append('<br>').append(results);

				if (data.result.files.rejects > 0) {
					var rejects = $('<span class="text-danger"/>').text(data.result.files.rejects + ' Registros No Guardados');
					$(data.context.children()[index]).append('<br>').append(rejects)
				}
			});
		}).on('fileuploadfail', function(e, data) {
			$.each(data.files, function(index) {
				var error = $('<span class="text-danger"/>').text(data.result.error);
				$(data.context.children()[index]).append('<br>').append(error);
			});
		}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
	}); 
</script>
@endsection
