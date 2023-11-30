<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function Register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:students',
            'password'=>'required|confirmed',
        ]);

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password =$request->password;
        $student->phone = $request->phone;
        $student->save();

        return response()->json([
            'status'=>true,
            'message'=>'the student true register succcefully',

        ]);

    }

    public  function login(Request $request){
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        $student = Student::where("email", "=", $request->email)->first();

        if(isset($student->id)){
            $token = $student->createToken("auth_token")->plainTextToken;
                return response()->json([
                    "status" => true,
                    "message" => "Student logged in successfully",
                    "access_token" => $token]);
        }else{
            return response()->json([
                "status" => false,]);
        }
    }

    public  function profile():Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            return Response(['data' => $user],200);
        }
        return Response(['data' => 'Unauthorized'],401);
    }

    public  function logout():Response
    {
        $user = Student::user();
        $user->currentAccessToken()->delete();
        return Response(['data' => 'User Logout successfully.'],200);
    }

}

