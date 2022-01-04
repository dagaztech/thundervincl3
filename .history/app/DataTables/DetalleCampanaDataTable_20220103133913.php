<?php



namespace App\DataTables;



use App\Models\DetalleCampana;

use Form;

use Yajra\Datatables\Services\DataTable;



class DetalleCampanaDataTable extends DataTable

{



    /**

     * Display ajax response.

     *

     * @return \Illuminate\Http\JsonResponse

     */

    public function ajax()

    {

        return $this->datatables

            ->eloquent($this->query())

            //->addColumn('action', 'detallecampanas.datatables_actions')

            ->make(true);

    }



    /**

     * Get the query object to be processed by dataTables.

     *

     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection

     */

    public function query()

    {

        $key = $this->key;



        if(!empty($key)){

            $detalle_campanas = DetalleCampana::query()->where('detalle_campanas.marca_id', $key)->with('marca', 'vins')->orderBy('detalle_campanas.id','desc');
            $estado_campanas = EstadoCampana::query()->where('vins.marca_id', $key)->with('marca', 'vins')->orderBy('vins.id','desc');

        }else{

            $detalle_campanas = DetalleCampana::query()->with('marca', 'vins')->orderBy('detalle_campanas.id','desc'); 
            $estado_campanas = EstadoCampana::query()->with('marca', 'vins')->orderBy('vins.id','desc'); 

        }


        return $this->applyScopes($detalle_campanas);

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

            //->addAction([ 'title' => 'Acciones'])

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

    protected function getColumns()

    {

        return [

            'marca' => ['name' => 'marca_id', 'data' => 'marca.nombre'],

            'campa&ntilde;a' => ['name' => 'campana', 'data' => 'campana'],

            'vines_asociados' => ['name' => 'vin', 'data' => 'vin'],

            'fecha_inicio_campana' => ['name' => 'vins.fecha_inicio_campana', 'data' => 'vins.fecha_inicio_campana'],

            'importador' => ['name' => 'importer_dealer', 'data' => 'importer_dealer'],

            'vendedor' => ['name' => 'vendedor', 'data' => 'vendedor'],

            'criterio' => ['name' => 'criterio', 'data' => 'criterio'],

            'fecha_ejecuci&oacute;n' => ['name' => 'fecha_ejecucion_campana', 'data' => 'fecha_ejecucion_campana'],

            'labor' => ['name' => 'labour', 'data' => 'labour'],

            'partes' => ['name' => 'parts', 'data' => 'parts'],

            'conteo' => ['name' => 'count', 'data' => 'count'],

            'importador_2' => ['name' => 'dealer_que_ejecuta_campana', 'data' => 'dealer_que_ejecuta_campana'],

            'ejecutor' => ['name' => 'importer_ejecuta', 'data' => 'importer_ejecuta'],

            'estado' => ['name' => 'estado', 'data' => 'estado'],

        ];

    }



    /**

     * Get filename for export.

     *

     * @return string

     */

    protected function filename()

    {

        return 'detallecampanas_' . time();

    }

}