<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use App\Http\Requests;

use App\Http\Controllers\AppBaseController;

use App\DataTables\DetalleCampanaDataTable;

use App\Http\Requests\CreateDetalleCampana;

use App\Http\Requests\UpdateDetalleCampana;

use App\Repositories\DetalleCampanaRepository;

use Flash;

use App\Models\Marca;

use App\Models\DetalleCampana;

use DataTables;

use Excel;

use App\Models\Vin;



class DetalleCampanaController extends Controller

{

    /** @var  DetalleCampanaRepository */

    private $detalleCampanaRepository;



    public function __construct(DetalleCampanaRepository $detalleCampanaRepo)

    {

        ini_set('max_execution_time', 1800);

        

        ini_set('memory_limit', '50M');



        

        $this->detalleCampanaRepository = $detalleCampanaRepo;

    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        set_time_limit(0);

        ini_set('memory_limit','2048M');

        $marcas = Marca::all();

        $vins = Vin::all();

        return view('detallecampanas.index',compact('marcas', 'vins')); 

    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function obtenerCampanas(Request $request)

    {
        $vins = Vin::where('marca_id',$request->marca_id)->select('campana')->distinct()->pluck('campana');
        return response()->json([
            $vins
        ], 200);
    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $marcas = Marca::all();



        return view('detallecampanas.create')->with('marcas', $marcas);

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  CreateDetalleCampana $request 

     * @return \Illuminate\Http\Response

     */

    public function store(CreateDetalleCampana $request)

    {

        $input = $request->all();



        $detallecampana = $this->detalleCampanaRepository->create($input);



        $marca = $detallecampana->marca_id;



        Flash::success('Detalle de Campaña creado exitosamente.');



        return redirect(route('vins.marca', $marca));

    }



    /**

     * Display the specified detallecampana.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $detallecampana = $this->detalleCampanaRepository->findWithoutFail($id);



        if (empty($detallecampana)) {

            Flash::error('Detalle de Campaña no encontrado');



            return redirect(route('vins.marca', $detallecampana->marca_id));

        }



        return view('detallecampanas.show')->with('detallecamapna', $detallecampana);

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $detallecampana = $this->detalleCampanaRepository->findWithoutFail($id);

        

        $marcas = Marca::all();



        if (empty($detallecampana)) {

            Flash::error('Detalle de Campaña no encontrado');



            return redirect(route('vins.marca', 1));

        }

        return view('detallecampanas.edit')->with(['detallecampana' => $detallecampana, 'marcas'=> $marcas]);

    }



    /**

     * Update the specified detallecampana in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(UpdateDetalleCampana $request, $id)

    {

        $detallecampana = $this->detalleCampanaRepository->findWithoutFail($id);



        if (empty($detallecampana)) {

            Flash::error('VIN no encontrado');



            return redirect(route('vins.index'));

        }

        $data = $request->all();

        if(empty($data['fecha_ejecucion_campana'])){

            $data['fecha_ejecucion_campana'] = null;

        }

        if(empty($data['count'])){

            $data['count'] = null;

        }

        if(empty($data['importer_dealer'])){

            $data['importer_dealer'] = null;

        }

        if(empty($data['criterio'])){

            $data['criterio'] = null;

        }

        if(empty($data['labour'])){

            $data['labour'] = null;

        }

        if(empty($data['parts'])){

            $data['parts'] = null;

        }

        

        $detallecampana = $this->detalleCampanaRepository->update($data, $id);



        Flash::success('Detalle de Camapaña actualizado exitosamente.');



        return redirect(route('vins.marca', $detallecampana->marca_id));

    }



    /**

     * Remove the specified detallecampana from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $detallecampana = $this->detalleCampanaRepository->findWithoutFail($id);



        if (empty($detallecampana)) {

            Flash::error('Detalle de Campaña no encontrado');



            return redirect(route('vins.marca', 1));

        }

        $marca_id = $detallecampana->marca_id;



        $this->detalleCampanaRepository->delete($id);



        Flash::success('Detalle de Campaña borrado exitosamente.');



        return redirect(route('vins.marca', $marca_id));

    }



     /**

     * Exportar en excel historial de campañas por marca.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function exportarPorMarca(Request $request)

    {
        set_time_limit(0);

        ini_set('memory_limit','2048M');

        $marca = Marca::find($request->marca_id);

		$campana = "";
        if($request->has('campana_select')){
            $campana = $request->campana_select;
		}
        
        if($request->has('campana_input')){
            $campana = $request->campana_input;
		}
        

        Excel::create('Historial -'.$marca->nombre, function($excel) use ($marca, $campana){
            $excel->sheet('Estado de Campaña', function($sheet) use ($marca, $campana) {
				if($campana != ""){
					$historiales = DetalleCampana::select('marcas.codigo as marca', 'campana', 'atendido', 'nombre', 'descripcion', 'lineas_afectadas_por_campanas', 'fecha_inicio_campana', 'modelos_vehiculos_afectados', 'info_adicional', 'estado')->join('marcas','marcas.id','marca_id')->where('marca_id', $marca->id)->where('campana', $campana)->get()->toArray();
				}
				else{
					$historiales = DetalleCampana::select('marcas.codigo as marca', 'campana', 'atendido', 'nombre', 'descripcion', 'lineas_afectadas_por_campanas', 'fecha_inicio_campana', 'modelos_vehiculos_afectados', 'info_adicional', 'estado')->join('marcas','marcas.id','marca_id')->where('marca_id', $marca->id)->get()->toArray();
				}
				if(count($historiales) > 0){
					$datos = array();
					foreach($historiales as $hist){
						unset($hist[0]);
						unset($hist[1]);
						unset($hist[2]);
						unset($hist[3]);
						unset($hist[4]);
						unset($hist[5]);
						unset($hist[6]);
						unset($hist[7]);
						unset($hist[8]);
						unset($hist[9]);
						unset($hist[10]);
						unset($hist[11]);
						$datos[] = $hist;
					}
				}
                $sheet->fromArray($datos);
            });
        })->download('xlsx');
    }

}

