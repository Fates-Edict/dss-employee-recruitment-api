<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UsersRepository;

class AuthController extends Controller
{
    protected $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required'
            ], 
            [
                'username' => hValidatorMessage('Username', 'required'),
                'password' => hValidatorMessage('Password', 'required')
            ]);

            if ($validator->fails()) return hResponse($validator->errors(), 'credentials error', 400);
            $data = $this->usersRepository->login($request);
            return hResponse($data['data'], $data['result'], $data['status']);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
