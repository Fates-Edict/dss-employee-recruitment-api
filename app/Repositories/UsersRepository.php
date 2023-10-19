<?php

namespace App\Repositories;
use App\Models\User;
use App\Traits\BaseRepository;
use Illuminate\Support\Facades\Hash;

class UsersRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(User $users)
    {
        $this->model = new User;
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
            if($request->password) $data->password = Hash::make($request->password);
            $data->save();
            return $data;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function me($request)
    {
        try {
            $currentlyLogin = auth()->user();
            $user = $this->model->where('id', $currentlyLogin->id)->with(['Role'])->first();
            return $user;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function login($request)
    {
        try {
            $response = [
                'result' => false,
                'details' => []
            ];
            
            $user = $this->model->where('username', $request->username)->first();
            if(!$user) {
                $response = [
                    'result' => false,
                    'data' => [
                        'username' => ['Username tidak terdaftar.']
                    ],
                    'status' => 400
                ];
                return $response;
            } else {
                $checkPassword = Hash::check($request->password, $user->password);
                if(!$checkPassword) {
                    $response = [
                        'result' => false,
                        'data' => [
                            'password' => ['Password tidak sesuai.']
                        ],
                        'status' => 400
                    ];
                    return $response;
                }
                $token = $user->createToken('Personal Access Token')->plainTextToken;
                $response = [
                    'result' => true,
                    'data' => ['token' => $token],
                    'status' => 200
                ];
                return $response;
            }
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}