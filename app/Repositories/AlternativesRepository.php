<?php

namespace App\Repositories;
use App\Models\Alternatives;
use App\Models\CriteriaAlternatives;
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

    public function store($request, $id)
    {
        try {
            $data = $this->initModel($id);
            $data->fill($request->all());
            if($data->save()) {
                CriteriaAlternatives::where('alternative_id', $data->id)->delete();
                foreach($request['criteria_alternatives'] as $row) {
                    CriteriaAlternatives::create([
                        'alternative_id' => $data->id,
                        'criteria_id' => $row['criteria_id'],
                        'value' => $row['value']
                    ]);
                }
            }
            return $data;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}