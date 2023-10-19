<?php

namespace App\Traits;

trait BaseRepository
{
    public function searchable()
    {
        return $this->model->searchable ?? [];
    }

    public function index($request)
    {
        try {
            $paginate = $request->paginate ?? 0;
            $orderBy = $request->order ? explode(':', $request->order) : null;
            if($request->has('table')) {
                $data = $this->model;
                if($orderBy) $data = $data->orderBy($orderBy[0], $orderBy[1]);
                if($request->s) {
                    $columns = $this->searchable();
                    foreach($columns as $key => $value) {
                        if($key === 0) $data = $data->where($value, 'ILIKE', '%' . $request->s . '%');
                        $data = $data->orWhere($value, 'ILIKE', '%' . $request->s . '%');
                    }
                }
                $data = $data->paginate($paginate);
            } else {
                $data = $this->model;
                if($orderBy) $data = $data->orderBy($orderBy[0], $orderBy[1]);
                if($request->limit) $data = $data->limit($request->limit);
                $data = $data->get();
            }
            return $data;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function findById($request, $id)
    {
        try {
            $data = $this->initModel($id);
            return $data;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function store($request, $id)
    {
        try {
            $data = $this->initModel($id);
            $data->fill($request->all());
            $data->save();
            return $data;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function destroy($request, $id)
    {
        try {
            $result = false;
            $data = $this->model->where('id', $id)->first();
            if($data) {
                $data->delete();
                $result = true;
            } else $result = false;
            return $result;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}