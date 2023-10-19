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
                $data = $data->paginate($paginate);
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
}