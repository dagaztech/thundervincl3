<?php



namespace App\DataTables;



use App\Models\VinVolks;

use Form;

use Yajra\Datatables\Services\DataTable;



class VinVolksDataTable extends DataTable

{



    /**

     * @return \Illuminate\Http\JsonResponse

     */

    public function ajax()

    {

        return $this->datatables

            ->eloquent($this->query())

            ->addColumn('action', 'vins.datatables_actions')

            ->make(true);

    }



    /**

     * Get the query object to be processed by datatables.

     *

     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder

     */

    public function query()

    {

        $vins = VinVolks::query()->with('marca')->whereNull('deleted_at')->orderBy('id','desc');
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

            ->addAction([ 'title' => 'Acciones'])

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

            'marca' => ['name' => 'marca_id', 'data' => 'marca.nombre'],

            'campa&ntilde;a' => ['name' => 'campana', 'data' => 'campana'],

            /*'vines' => ['name' => 'vines', 'data' => 'vines'],*/

            'nombre' => ['name' => 'nombre', 'data' => 'nombre'],

            'descripción' => ['name' => 'descripcion', 'data' => 'descripcion'],

            'cierre_campana' => ['name' => 'atendido', 'data' => 'atendido'],

            'lineas_afectadas_por_campanas' => ['name' => 'lineas_afectadas_por_campanas', 'data' => 'lineas_afectadas_por_campanas'],

            'fecha_inicio_campana' => ['name' => 'fecha_inicio_campana', 'data' => 'fecha_inicio_campana'],

            'modelos_vehiculos_afectados' => ['name' => 'modelos_vehiculos_afectados', 'data' => 'modelos_vehiculos_afectados'],

            'info_adicional' => ['name' => 'info_adicional', 'data' => 'info_adicional'],

        ];

    }



    /**

     * Get filename for export.

     *

     * @return string

     */

    protected function filename()

    {

        return 'vinsVolks';

    }

}

