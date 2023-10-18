<?php

namespace App\Traits;

trait BaseRepository
{
    public function index($request)
    {
        try {
            $paginate = $request->paginate ?? 0;
            $orderBy = $request->order ? explode(':', $request->order) : null;
            if($request->has('table')) {
                $data = 'anjing';
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
}