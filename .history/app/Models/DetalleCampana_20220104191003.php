<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\LogsActivityInterface;

use Spatie\Activitylog\LogsActivity;



/**

 * Class Vin

 * @package App\Models

 * @version December 26, 2017, 11:22 am UTC

 *

 * @property string vin

 * @property string importer_dealer

 * @property integer criterio

 * @property string fecha_ejecucion_campana

 * @property decimal labour

 * @property decimal parts

 * @property integer count

 * @property string codigo_borrado

 * @property string column9

 * @property string column10

 * @property string column12

 * @property string dealer_que_ejecuta_campana
 
 * @property string vines
 * @property string campana
 * @property string vendedor
 * @property string ano
 * @property string modelo
 * @property string ciudad
 * @property date atendido
 * @property string nombre
 * @property string descripcion
 * @property string lineas_afectadas_por_campanas
 * @property date fecha_inicio_campana
 * @property string modelos_vehiculos_afectados
 * @property string info_adicional
 * @property string estado
 * @property date created_at
 * @property date updated_at

 */

class DetalleCampana extends Model implements LogsActivityInterface

{

    use LogsActivity;



    //public $table = 'detalle_campanas';
    public $table = 'v_historical';

    

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';





    public $fillable = [
        'vin_id',
        'marca_id',
        'vines',
        'campana', 
        'vendedor',
        'ano',
        'modelo',
        'ciudad',
        'atendido', 
        'nombre', 
        'descripcion', 
        'lineas_afectadas_por_campanas', 
        'fecha_inicio_campana', 
        'modelos_vehiculos_afectados', 
        'info_adicional', 
        'estado',
        'created_at',
        'updated_at',
        'vin',
        'importer_dealer',
        'vendedor',
        'criterio',
        'fecha_ejecucion_campana',
        'dealer_que_ejecuta_campana',
        'importer_ejecuta'

    ];



    /**

     * Validation rules

     *

     * @var array

     */

    public static $rules = [

        'marca_id' => 'required|numeric',

        'vin' => 'required|max:255|exists:vins,vines',

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

            return 'Detalle de campana "' . $this->vin . '" fue creado';

        }



        if ($eventName == 'updated')

        {

            return 'Detalle de campana "' . $this->vin . '" fue actualizado';

        }



        if ($eventName == 'deleted')

        {

            return 'Detalle de campana "' . $this->vin . '" fue eliminado';

        }



        return '';

    }



    /**

     * Get the marca for the detalle campana.

     */

    public function marca()

    {

        return $this->belongsTo('App\Models\Marca');

    }



    /**

     * Get the marca for the detalle campana.

     */

    public function vins()

    {

        return $this->belongsTo('App\Models\Vin', 'campana', 'campana');

    }



        /**

     * Get the historial_busquedas for the vin.

     */

    public function historial_busquedas()

    {

        return $this->hasMany('App\Models\Historial_busqueda', 'texto_busqueda', 'vin');

    }

}

