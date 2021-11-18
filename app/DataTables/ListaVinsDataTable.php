<?php



namespace App\DataTables;



use App\Models\Vin;
use App\Models\ListaVin;

use Form;


use Yajra\Datatables\Services\DataTable;



class ListaVinsDataTable extends DataTable

{



    /**

     * @return \Illuminate\Http\JsonResponse

     */

    public function ajax()

    {

        return $this->datatables

            ->eloquent($this->query())

            ->make(true);

    }



    /**

     * Get the query object to be processed by datatables.

     *

     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder

     */

    public function query()
    {

        $vins = ListaVin::query();
        //var_dump($vins);

        return $this->applyScopes($vins);

    }



    /**

     * Optional method if you want to use html builder.

     *

     * @return \Yajra\Datatables\Html\Builder

     */

    public function html()

    {

        return $this->builder()

            ->columns($this->getColumns())

            ->ajax('')

            ->parameters([

                'dom' => 'Bfrtip',

                'scrollX' => true,

                "language" => [

                    "url" => "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"

                ],

                'buttons' => [

                    ['extend' => 'print', 'text' => '<i class="fa fa-print"></i> Imprimir'],

                    ['extend' => 'reset', 'text' => '<i class="fa fa-undo"></i> Resetear'],

                    ['extend' => 'reload', 'text' => '<i class="fa fa-refresh"></i> Recargar'],

                    ['extend' => 'colvis', 'text' => 'Visibilidad de la Columna'],

                    [

                         'extend'  => 'collection',

                         'text'    => '<i class="fa fa-download"></i> Exportar',

                         'buttons' => [

                             'csv',

                             'excel',

                         ],

                    ],   

                ]

            ]);

    }



    /**

     * Get columns.

     *

     * @return array

     */

    private function getColumns()

    {

        return [

            'marca' => ['name' => 'marca', 'data' => 'marca'],

            'vin' => ['name' => 'vin', 'data' => 'vin'],

            'rut' => ['name' => 'rut', 'data' => 'rut'],

            'campaña' => ['name' => 'campana', 'data' => 'campana'],

            'fecha_ult_consulta' => ['name' => 'fecha_ult_consulta', 'data' => 'fecha_ult_consulta'],

            'cantidad_consultas' => ['name' => 'cantidad_consultas', 'data' => 'cantidad_consultas'],
        ];
    }



    /**
     * Get filename for export
     * @return string

     */

    protected function filename()
    {
        return 'listavins';
    }
}

