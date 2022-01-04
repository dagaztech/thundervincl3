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

            'Marca' => ['name' => 'marca_id', 'data' => 'marca.nombre'],

            'Campa&ntilde;a' => ['name' => 'campana', 'data' => 'campana'],

            'Vines asociados' => ['name' => 'vin', 'data' => 'vin'],

            'Fecha inicio campa&ntilde;a' => ['name' => 'vins.fecha_inicio_campana', 'data' => 'vins.fecha_inicio_campana'],

            'Importador' => ['name' => 'importer_dealer', 'data' => 'importer_dealer'],

            'Vendedor' => ['name' => 'vendedor', 'data' => 'vendedor'],

            'Criterio' => ['name' => 'criterio', 'data' => 'criterio'],

            'Fecha ejecuci&oacute;n' => ['name' => 'fecha_ejecucion_campana', 'data' => 'fecha_ejecucion_campana'],

            'Labor' => ['name' => 'labour', 'data' => 'labour'],

            'Partes' => ['name' => 'parts', 'data' => 'parts'],

            'Conteo' => ['name' => 'count', 'data' => 'count'],

            'Importador_2' => ['name' => 'dealer_que_ejecuta_campana', 'data' => 'dealer_que_ejecuta_campana'],

            'Ejecutor' => ['name' => 'importer_ejecuta', 'data' => 'importer_ejecuta'],

            'Estado' => ['name' => 'estado', 'data' => 'estado'],

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