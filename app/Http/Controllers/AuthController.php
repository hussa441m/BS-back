<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:175|unique:users',
            'password' => 'required|confirmed|min:6',
            'type' => 'required|in:provider,customer',
            'experience_start' => 'required_if:type,provider|date',
            'role_id' => 'required_if:type,provider|exists:roles,id',
        ]);
        
        $validated['status'] = $request->type == 'provider'? 'pending' : 'active';
        
        $user = User::create(
            $validated
        );
        $type = $user->type;
        $name = $user->name;
        $token = $user->createToken("mobile")->plainTextToken;

        if ($type == 'provider') {            
            $user->profile()->create([                
                'experience_start' => $validated['experience_start'],
                'role_id' => $validated['role_id'],                
            ]);
        }
        return apiSuccess('تم إنشاء الحساب بنجاح ', compact('type', 'name', 'token'));
    }

    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails())
            return apiError("invalid inputs", $validator->messages(),  Response::HTTP_UNPROCESSABLE_ENTITY);

        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            $type = $user->type;

            $name =  $user->name;
            $token = $user->createToken("web api")->plainTextToken;
            return apiSuccess("Account login successfuly", compact('type', 'name', 'token'), Response::HTTP_CREATED);
        }
        return apiError("اسم المستخدم أو كلمة المرور غير صحيحة");
    }

    function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return apiSuccess("logout ok");
    }
}
