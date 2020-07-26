<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
 

    public function login(LoginRequest $request)
    {
    
        try{
            $user = User::where(['email'=> $request->email,'is_admin'=>0])
            ->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                
                return response()->json([
                    'status' => false,
                    'message' => "Email or password not valid"
                ],422);
            }

            $device_name = 'my-app-token';

            $token  = $user->tokens()->delete();

            return response()->json([
                'status' => true,
                'data' => array(
                    'user' => $user->only('id','name','email'),
                    'token'=>$user->createToken($device_name)->plainTextToken
                    )
                ]);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => false
            ],500);
        }  
    }
    
    public function logout(Request $request)
    {
       
    }
}
