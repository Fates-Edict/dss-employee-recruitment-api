<?php

namespace App\Repositories;
use App\Models\Alternatives;
use App\Traits\BaseRepository;
use Illuminate\Support\Str;

class AlternativesRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Alternatives $model)
    {
        $this->model = new Alternatives;
    }

    public function initModel($id = null)
    {
        $model = $this->model;
        if($id) $model = $this->model->where('id', $id)->first();
        return $model;
    }
}