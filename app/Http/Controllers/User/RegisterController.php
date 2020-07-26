<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\User;
use App\Models\friend;

class RegisterController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        try{
            
            $newUser = User::where('email',$request->email)->first();
        if($newUser){
            return response()->json([
                "message" => "The User already exist",
                'status' => false,
            ]);
        }


        $newUser = new User();

        $newUser->email = $request->email;
        $newUser->password = bcrypt($request->password);
        $newUser->name = $request->name;
        $newUser->save();

        $adminUser = User::where('is_admin',1)->select('id')->get()->pluck('id');

        foreach($adminUser as $id){
            $newFriend  = new friend();
            $newFriend->user_id = $newUser->id;
            $newFriend->friend_id = $id;
            $newFriend->save();

            $newFriend  = new friend();
            $newFriend->user_id = $id;
            $newFriend->friend_id = $newUser->id;
            $newFriend->save();
        }
        
        return response()->json([
            "message" => "You have been registered Successfully",
            'status' => true,
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
}
