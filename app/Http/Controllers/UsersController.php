<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    protected $repository;

    public function __construct(UsersRepository $repository)
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

    public function validator($request, $id)
    {
        $result = false;
        $message = [];
        $user = User::find($id);

        $validator = Validator::make($request->all(), 
        [
            'role_id' => 'required',
            'username' => [
                'required',
                Rule::unique('pgsql.master.users')->ignore($user)
            ],
            'name' => 'required',
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                Rule::requiredIf(!$id)
            ]
        ],
        [
            'name.required' => hValidatorMessage('Nama', 'required'),
            'role_id.required' => hValidatorMessage('Role', 'required'),
            'username.required' => hValidatorMessage('Username', 'required'),
            'username.unique' => hValidatorMessage('Username', 'unique'),
            'email.required' => hValidatorMessage('Email', 'required'),
            'email.email' => hValidatorMessage('Email', 'email'),
            'password.required' => hValidatorMessage('Password', 'required')
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

    public function me(Request $request)
    {
        try {
            $data = $this->repository->me($request);
            return hResponse($data);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}