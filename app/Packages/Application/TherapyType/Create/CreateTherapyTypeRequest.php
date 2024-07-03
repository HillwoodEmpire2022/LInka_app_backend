<?php

namespace App\Packages\Application\TherapyType\Create;
use Illuminate\Http\Request;

class CreateTherapyTypeRequest{

    protected $name;
    protected $description;


    public function __construct(Request $request)
    {
        $this->name = $request->input('name');
        $this->description = $request->input('description');
    }

    public function getName(){
        return $this->name;
    }

    
    public function getDescription(){
        return $this->description;
    }
}