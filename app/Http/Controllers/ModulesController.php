<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modules;
use App\Repositories\ModulesRepository;

class ModulesController extends Controller
{
    protected $repository;

    public function __construct(ModulesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $data = $this->repository->index($request);
            return hResponse($data);
        } catch(Exception $e) {
            throw new Exception($e);
        }
    }
}
