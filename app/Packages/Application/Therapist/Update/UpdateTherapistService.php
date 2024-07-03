<?php

namespace App\Packages\Application\Therapist\Update;
use App\Packages\Application\Therapist\Update\UpdateTherapistRequest;
use App\Packages\Infrastructure\TherapistRepository;

class UpdateTherapistService{

    protected $id;
    protected $full_name;
    protected $specialization;
    protected $phone_number;
    protected $therapistRepository;


    public function __construct(UpdateTherapistRequest $updateTherapistRequest, TherapistRepository $therapistRepository)
    {
        $this->id = $updateTherapistRequest->getID();
        $this->full_name = $updateTherapistRequest->getFull_name();
        $this->specialization = $updateTherapistRequest->getSpecialization();
        $this->phone_number = $updateTherapistRequest->getPhone_number();
        $this->therapistRepository = $therapistRepository;
    }

    public function updateTherapist(){
        return $this->therapistRepository->updateTherapist($this->id, ['Full_names'=>$this->full_name,'Specialization'=>$this->specialization,'Phone_ontact'=>$this->phone_number]);
    }
}