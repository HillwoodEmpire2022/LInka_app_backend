<?php

namespace App\Packages\Application\Therapy\Update;

use Illuminate\Http\Request;

class UpdateTherapyRequest{


    protected $id;
    protected $name;


    public function __construct(Request $request)
    {
        $this->id = $request->input('id');
        $this->name = $request->input('name');
    }

    public function getID(){

        return $this->id;

    }

    public function getName(){

        return $this->name;
    }
}