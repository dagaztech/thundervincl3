<?php

namespace App\Repositories;

use App\Models\Notificacion;
use InfyOm\Generator\Common\BaseRepository;

class NotificacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'ip',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Notificacion::class;
    }
}
