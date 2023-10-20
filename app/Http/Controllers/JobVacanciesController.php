<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobVacancies;
use App\Repositories\JobVacanciesRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JobVacanciesController extends Controller
{
    protected $repository;

    public function __construct(JobVacanciesRepository $repository)
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
        $jobVacancy = JobVacancies::find($id);

        $validator = Validator::make($request->all(), 
        [
            'name' => [
                'required',
                Rule::unique('pgsql.master.job_vacancies')->ignore($jobVacancy)
            ]
        ],
        [
            'name.required' => hValidatorMessage('Nama', 'required'),
            'name.unique' => hValidatorMessage('Nama', 'unique')
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
