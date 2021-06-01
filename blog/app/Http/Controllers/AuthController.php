<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(CreateUser $request)
    {
        $validatedDate = $request->validated();
        $user = new User([
            'name'=>$validatedDate['name'],
            'email'=>$validatedDate['email'],
            'password'=>bcrypt($validatedDate['password']),
        ]);
        $user->save();
        return response('success',201);
    }

    public function login(Request $request)
    {
        $validatedDate = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);
        if(!Auth::attempt($validatedDate)){
            return response('驗證失敗',401);
        }
        else 
        {
            //return response('登入成功');
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Token');
        $tokenResult->token->save();
        return response(['token'=>$tokenResult->accessToken]);
        
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response(['message'=>'成功登出']);
    }
    public function user(Request $request)
    {
        return response($request->user());
    }
}
