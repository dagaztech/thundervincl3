<?php

namespace App\Repositories;

use App\Models\Exportacion;
use InfyOm\Generator\Common\BaseRepository;

class ExportacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'ip'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Exportacion::class;
    }
}
