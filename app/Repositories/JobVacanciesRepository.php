<?php

namespace App\Repositories;
use App\Models\JobVacancies;
use App\Traits\BaseRepository;
use Illuminate\Support\Str;

class JobVacanciesRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(JobVacancies $model)
    {
        $this->model = new JobVacancies;
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