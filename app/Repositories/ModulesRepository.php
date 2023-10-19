<?php

namespace App\Repositories;
use App\Models\Modules;
use App\Traits\BaseRepository;
use Illuminate\Support\Str;

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

    public function store($request, $id)
    {
        try {
            $data = $this->initModel($id);
            $data->fill($request->all());
            $data->slug = Str::of($request->name)->slug('-');
            $data->save();
            return $data;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}