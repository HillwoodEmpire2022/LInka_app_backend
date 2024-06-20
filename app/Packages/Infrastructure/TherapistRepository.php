<?php

namespace App\Packages\Infrastructure;
use App\Models\Therapist;


class TherapistRepository{

    protected $therapistModels;

    public function __construct()
    {
        $this->therapistModels = new Therapist();
    }

    public function createTherapist(string $full_name, string $specialization, string $phone_number, ){

        return $this->therapistModels::create([
            'Full_names'=>$full_name,
            'Specialization'=>$specialization,
            'Phone_ontact'=>$phone_number,
        ]);

    }

    public function getAllTherapist(){

        return $this->therapistModels->get();

    }

    public function getOneTherapist(int $id){

        return $this->therapistModels->where('id', $id)->get();

    }

    public function updateTherapist(int $id, array $data){

        $therapyID = $this->therapistModels::findOrFail($id);
        return $therapyID->update($data);

    }

    public function deleteTherapist(int $id){

        return $this->therapistModels->destroy($id);
        
    }
}