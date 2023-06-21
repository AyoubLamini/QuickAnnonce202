<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'tele' => 'required',
        ]);
        if ($validator->fails())  {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        else {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token']=$user->createToken('myApp')->accessToken;
            return response()->json(['success' => $success], 200); 
        }
    }
    public function login(Request $request) {
        if(Auth::attempt(['email' => $request->email, 'password'=>$request->password])) {
            $user = Auth::user();
            $success['Token'] = $user->createToken('myApp')->accessToken;
            return response()->json(['success' => $success], 200);
        }else {
            return response()->json(['error' => 'non autorisé'], 401);
        }
    }
    public function getUser() {
        $user = Auth::user();
        return response()->json(['success' => $user], 200);
    }
}