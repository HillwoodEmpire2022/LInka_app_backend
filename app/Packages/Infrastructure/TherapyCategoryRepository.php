<?php

namespace App\Packages\Infrastructure;
use App\Models\Therapy_Category;


class TherapyCategoryRepository{

    protected $therapyModel;

    public function __construct()
    {
        $this->therapyModel = new Therapy_Category();
    }

    public function getAll(){

        return $this->therapyModel->get();
    }

    public function getOne(string $id){

        return $this->therapyModel->where('id', $id)->get();
    }

    public function deleteTherapy(string $id){

        $therapyID = $this->therapyModel::findOrFail($id);
        
        return $this->therapyModel->destroy($therapyID);
    }

    public function updateTherapy(string $id, array $data){

        $therapyID = $this->therapyModel::findOrFail($id);

        return $therapyID->update($data);
    }

    public function createTherapy(string $name, string $coverImage){

        return $this->therapyModel::create([
            'Category_name'=>$name,
            'cover_image'=>$coverImage,
        ]);
    }
}