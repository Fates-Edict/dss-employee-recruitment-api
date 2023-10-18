<?php

namespace App\Repositories;
use App\Models\Modules;
use App\Traits\BaseRepository;

class ModulesRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Modules $modules)
    {
        $this->model = new Modules;
    }

    public function initModel($id = null)
    {
        $model = $this->model;
        if($id) $model = $this->model->where('id', $id)->first();
        return $model;
    }
}