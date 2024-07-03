<?php

namespace App\Packages\Application\TherapyType\Update;

use Illuminate\Http\Request;

class UpdateTherapyTypeRequest{

    protected $name;
    protected $description;
    protected $id;

    public function __construct(Request $request)
    {
        $this->id = $request->input('id');
        $this->name = $request->input('name');
        $this->description = $request->input('description');
    }

    public function getID(){
        return $this->id;
    }
    
    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }
}