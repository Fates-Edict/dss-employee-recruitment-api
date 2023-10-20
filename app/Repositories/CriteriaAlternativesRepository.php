<?php

namespace App\Repositories;
use App\Models\CriteriaAlternatives;
use App\Traits\BaseRepository;

class CriteriaAlternativesRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(CriteriaAlternatives $model)
    {
        $this->model = new CriteriaAlternatives;
    }

    public function initModel($id = null)
    {
        $model = $this->model;
        if($id) $model = $this->model->where('id', $id)->first();
        return $model;
    }
}