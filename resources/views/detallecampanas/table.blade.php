@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%']) !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script>
        $(function(){
            $('#form-exportar-marca').submit(function (e) { 
                e.preventDefault();
              
                var data = new FormData($(this));

                $.ajax({
                    type: "post",
                    url: "{{ route('detallecampana.exportar.marca') }}",
                    data: {marca_id: $('#marca_id').val(), _token:$('input[name=_token]').val()},
                    dataType: 'json',
                    success: function (response) {
                        console.log(response)
                    },
                    error: function(error){
                        alert('Ocurrió un error en el servidor por favor intentelo mas tarde!');
                    }
                });
            });  
        })
        </script>
@endsection