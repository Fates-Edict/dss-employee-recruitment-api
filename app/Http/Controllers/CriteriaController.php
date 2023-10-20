<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Repositories\CriteriaRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CriteriaController extends Controller
{
    protected $repository;

    public function __construct(CriteriaRepository $repository)
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

    public function findById(Request $request, $id = null)
    {
        try {
            $data = $this->repository->findById($request, $id);
            return hResponse($data);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function store(Request $request, $id = null)
    {
        $validate = $this->validator($request, $id);
        if($validate['result']) {
            $data = $this->repository->store($request, $id);
            $msg = 'success save data';
            if($id) $msg = 'success update data';
            return hResponse($data, $msg, 201);
        } else {
            $data = $validate['message'];
            return hResponse($data, 'error', 400);
        }
    }

    public function destroy(Request $request, $id = null)
    {
        try {
            $data = $this->repository->destroy($request, $id);
            $msg = 'success delete data';
            if($data) return hResponse([], $msg, 200);
            else return hResponse([], 'failed delete data', 400);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function validator($request, $id)
    {
        $result = false;
        $message = [];
        $criteria = Criteria::find($id);

        $validator = Validator::make($request->all(), 
        [
            'name' => [
                'required',
                Rule::unique('pgsql.master.criteria')->ignore($criteria)
            ],
            'type' => 'required'
        ],
        [
            'name.required' => hValidatorMessage('Nama', 'required'),
            'name.unique' => hValidatorMessage('Nama', 'unique'),
            'type.required' => hValidatorMessage('Tipe', 'required')
        ]);

        if($validator->fails()) {
            $result = false;
            $message = $validator->errors();
        } else {
            $result = true;
            $message = [];
        }

        return [
            'result' => $result,
            'message' => $message
        ];
    }
}
