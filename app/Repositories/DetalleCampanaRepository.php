<?php

namespace App\Repositories;

use App\Models\DetalleCampana;
use InfyOm\Generator\Common\BaseRepository;

class DetalleCampanaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vin',
        'campana',
        'vendedor',
        'importer_dealer',
        'criterio',
        'fecha_ejecuion_campana',
        'labour',
        'parts',
        'dealer_que_ejecuta_campana',
        'marca_id',
        'codigo_borrado'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DetalleCampana::class;
    }
}
