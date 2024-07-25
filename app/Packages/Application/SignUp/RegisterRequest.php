<?php

namespace App\Packages\Application\SignUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class RegisterRequest{

    protected $name;
    protected $email;
    // protected $username;
    protected $password;

    public function __construct(Request $request)
    {
        $this->name=$request->input('name');
        $this->email=$request->input('email');
        // $this->username=$request->input('username');
        $this->password=$request->input('password');
        $this->validate($request);

    }

    public function validate(Request $request){

        $rules = [
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            throw new Exception('Validation Failed: ' . implode(', ', $validator->errors()->all()));
        }

    }

    public function getName(){
        return $this->name;
    }
    public function getEmail(){
        return $this->email;
    }
    // public function getUsername(){
    //     return $this->username;
    // }
    public function getPassword(){
        return $this->password;
    }
}
