<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RolesRepository;

class RolesController extends Controller
{
    protected $repository;

    public function __construct(RolesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $data = $this->repository->index($request);
            return hResponse($data);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function findById(Request $request, $id)
    {
        try {
            $data = $this->repository->findById($request, $id);
            return hResponse($data);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function store(Request $request, $id)
    {
        dd($id);
    }
}
