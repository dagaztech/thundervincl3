<?php

namespace App\Repositories;

use App\Models\VinMans;
use InfyOm\Generator\Common\BaseRepository;

class VinMansRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'campana',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return VinMans::class;
    }
}
