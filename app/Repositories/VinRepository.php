<?php

namespace App\Repositories;

use App\Models\Vin;
use InfyOm\Generator\Common\BaseRepository;

class VinRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vines',
        'campana',
        'vendedor',
        'ano',
        'modelo',
        'ciudad',
        'atendido',
        'created_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Vin::class;
    }
}
