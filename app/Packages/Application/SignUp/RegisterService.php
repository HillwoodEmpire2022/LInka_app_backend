<?php

namespace App\Packages\Application\SignUp;
use App\Packages\Application\SignUp\RegisterRequest;
use App\Models\User;

class RegisterService{

    protected $name;
    protected $email;
    protected $username;
    protected $password;

    public function __construct(RegisterRequest $request)
    {
        $this->name=$request->getName();
        $this->email=$request->getEmail();
        // $this->username=$request->getUsername();
        $this->password=$request->getPassword();
    }

    public function create(){
        $user = User::create(array_merge([
            'name'=>$this->name, 
            'email'=>$this->email, 
            // 'username'=>$this->username, 
            'password'=>bcrypt($this->password)]));

        return response()->json([
            'message'=>'User Successfully registered',
            'user'=>$user
        ], 201);
    }
    

}