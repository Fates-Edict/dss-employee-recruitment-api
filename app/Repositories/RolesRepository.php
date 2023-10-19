<?php

namespace App\Repositories;
use App\Models\Roles;
use App\Traits\BaseRepository;

class RolesRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Roles $Roles)
    {
        $this->model = new Roles;
    }

    public function initModel($id = null)
    {
        $model = $this->model;
        if($id) $model = $this->model->where('id', $id)->first();
        return $model;
    }
}