<?php

namespace App\Packages\Application\Therapy\Find;

use Illuminate\Http\Request;

class FindOneTherapyRequest{


    protected $id;

    public function __construct(Request $request)
    {
        $this->id = $request->input('id');
    }

    public function getID(){

        return $this->id;
    }
}