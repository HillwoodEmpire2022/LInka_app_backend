<?php 

namespace App\Packages\Application\Therapy\Create;

use Illuminate\Http\Request;

class CreateTherapyRequest{

    protected $name;
    protected $coverImage;


    public function __construct(Request $request)
    {
        $this->name = $request->input('name');
        $this->coverImage = $request->file('image');
    }

    public function getName(){

        return $this->name;
    }

    public function getCoverImage(){

        return $this->coverImage;
    }
}