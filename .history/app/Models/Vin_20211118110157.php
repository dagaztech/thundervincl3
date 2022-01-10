<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;
use Auth;
use DB;
use Carbon\Carbon;

/**
 * Class Vin
 * @package App\Models
 * @version December 26, 2017, 11:22 am UTC
 *
 * @property string vines
 * @property string campana
 * @property string vendedor
 * @property string ano
 * @property string modelo
 * @property string ciudad
 * @property string atendido
 * @property string estado
 * @property string nombre
 * @property string descripcion
 * @property integer marca_id
 */
class Vin extends Model implements LogsActivityInterface
{
    //use SoftDeletes;
    use LogsActivity;

    public $table = 'vins';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'marca_id',
        'vines',
        'campana',
        'vendedor',
        'ano',
        'modelo',
        'ciudad',
        'atendido',
        'estado',
        'nombre',
        'descripcion',
        'lineas_afectadas_por_campanas',
        'fecha_inicio_campana',
        'modelos_vehiculos_afectados',
        'info_adicional'
    ];
    /**
     * Get the message that needs to be logged for the given event name.
     *
     * @param string $eventName
     * @return string
     */
    public function getActivityDescriptionForEvent($eventName)
    {
        if ($eventName == 'created')
        {
            return 'Vin ' . $this->vines . ', campaña ' . $this->campana . ', año ' . $this->ano . ', nombre ' . $this->nombre . ' fue creada';
        }

        if ($eventName == 'updated')
        {
            return 'Vin ' . $this->vines . ', campaña ' . $this->campana . ', año ' . $this->ano . ', nombre ' . $this->nombre . ' fue actualizada';
        }

        if ($eventName == 'deleted')
        {
            return 'Vin ' . $this->vines . ', campaña ' . $this->campana . ', año ' . $this->ano . ', nombre ' . $this->nombre . ' fue borrada';
        }

        return '';
    }

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'marca_id' => 'integer',
        'vines' => 'string',
        'campana' => 'string',
        'vendedor' => 'string',
        'ano' => 'string',
        'modelo' => 'string',
        'ciudad' => 'string',
        'atendido' => 'string',
        'estado' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string',
        'lineas_afectadas_por_campanas' => 'string',
        'fecha_inicio_campana' => 'string',
        'modelos_vehiculos_afectados' => 'string',
        'info_adicional' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'marca_id' => 'required|numeric',
        'campana' => 'required',
        'vines' => 'required',
        'nombre' => 'required',
        'lineas_afectadas_por_campanas' => 'required',
        'modelos_vehiculos_afectados' => 'required',
        'estado' => 'required',
        'descripcion' => 'required',
        //'info_adicional' => 'required',
    	//'fecha_inicio_campana' =>'date|after:18 years ago',
    	//'atendido' =>'date|after:18 years ago',
    ];

    /**
     * Get the historial_busquedas for the vin.
     */
    public function detalle_campanas()
    {
        return $this->hasMany('App\Models\DetalleCampana', 'vin_id');
    }
    
    /**
     * Get the marca for the vin.
     */
    public function marca()
    {
        return $this->belongsTo('App\Models\Marca');
    }
    
    /**
     * 
     */
    static function getCampanasConsultadas($id)
    {

        /*
         * Autor: Jhon Janer
         * Fecha: 22/05/2019
         * Se modifica query para contar las consultas efectivas agrupadas por vin y fecha_consulta
         */

        $campanas_mas_consultadas = DetalleCampana::query()
            ->selectRaw('detalle_campanas.campana, count(distinct detalle_campanas.id) as total_afectados, 0 as total_atendidos, 
            (SELECT IFNULL(SUM(v_vines_con.cantidad_consultas), 0)
                    FROM (select vcon.campana, vcon.cantidad_consultas from v_vines_consultas as vcon inner join v_campanas as 		
                    vcam on vcon.vin = vcam.vin group by vcon.vin, vcon.fecha_ult_consulta) as v_vines_con
                    WHERE v_vines_con.campana = detalle_campanas.campana) as consultas_efectivas,
                    COUNT(historial_busquedas.texto_busqueda) as consultas_web')
		    ->leftJoin('historial_busquedas', function($leftJoin){
            $leftJoin->on('detalle_campanas.campana', '=', 'historial_busquedas.campana');
            $leftJoin->on('detalle_campanas.vin', '=', 'historial_busquedas.texto_busqueda')
                ->where('historial_busquedas.estado', '=', 1 );
        })
		->where('detalle_campanas.marca_id', $id)->groupBy('detalle_campanas.campana')
            ->orderBy('consultas_efectivas','desc')->get();
		$resultado = collect();


		if($campanas_mas_consultadas->count() > 0){
			foreach ($campanas_mas_consultadas as $campana){
				$total_atendidos = DetalleCampana::query()
                ->selectRaw('COUNT(id) as total_atendidos')
				->where('detalle_campanas.campana', $campana->campana)
                ->where('detalle_campanas.marca_id', $id)
                ->whereRaw('fecha_ejecucion_campana<>""')
                    ->first();
				$campana->total_atendidos = $total_atendidos->total_atendidos;
				
				$resultado->push($campana);
			}
		}
		return $resultado;
    }
}
