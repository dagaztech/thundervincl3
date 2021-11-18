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
class DetalleVinVolks extends Model implements LogsActivityInterface
{
    //use SoftDeletes;
    use LogsActivity;

    public $table = 'detallevinvolks';
    
    //const CREATED_AT = 'created_at';
    //const UPDATED_AT = 'updated_at';


    //protected $dates = ['deleted_at'];

    public $fillable = [
            'vinvolksid',
            'dn',
            'vehicle',
            'startChasis',
            'endChasis',
            'status',
            'campana',
            'marca_id'
        ];


    /**
     * Get the message that needs to be logged for the given event name.
     *
     * @param string $eventName
     * @return string
     */
    public function getActivityDescriptionForEvent($eventName)
    {

        return '';
    }

}
