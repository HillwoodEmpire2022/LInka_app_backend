<?php

namespace App\Packages\Infrastructure;
use App\Models\TherapyType;


class TherapyTypeRepository{

    protected $therapymodel;


    public function __construct()
    {
        $this->therapymodel=new TherapyType();
    }

    public function createTherapyType(string $therapy_name, string $description){

        return $this->therapymodel::create([
            'Therapy_name'=>$therapy_name,
            'Description'=>$description,
        ]);

    }

    public function getAllTherapyType(){

        return $this->therapymodel->get();

    }

    public function getOneTherapyType(int $id){

        return $this->therapymodel->where('id', $id);

    }

    public function updateTherapyType(int $id, array $data){

        $therapyID = $this->therapymodel::findOrFail($id);
        return $therapyID->update($data);

    }

    public function deleteTherapyType(int $id){

        return $this->therapymodel->destroy($id);
        
    }
}