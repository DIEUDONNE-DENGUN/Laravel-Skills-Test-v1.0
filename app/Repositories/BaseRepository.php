<?php
/**
 * AUthor: Dieudonne Takougang
 * Date: 22/11/2020
 * Base repository class to support model initialization
 */

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}