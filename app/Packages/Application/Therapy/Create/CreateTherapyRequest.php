<?php 

namespace App\Packages\Application\Therapy\Create;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CreateTherapyRequest{

    protected $name;
    protected $coverImage;


    public function __construct(Request $request)
    {
        $this->name = $request->input('name');
        $this->coverImage = $request->file('image');
        $this->validate($request);
    }

    public function validate(Request $request){

        $rules = [
            'name'=>'required|string|max:1000',
            'image'=>'required|image|mimes:jpeg,jpg,png,gif|max:25600',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            throw new Exception('Validation Failed: ' . implode(', ', $validator->errors()->all()));
        }

    }

    public function getName(){

        return $this->name;
    }

    public function getCoverImage(){

        return $this->coverImage;
    }
}