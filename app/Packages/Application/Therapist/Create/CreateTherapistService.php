<?php

namespace App\Packages\Application\Therapist\Create;
use App\Packages\Application\Therapist\Create\CreateTherapistRequest;
use App\Packages\Infrastructure\TherapistRepository;

class CreateTherapistService{

    protected $full_name;
    protected $specialization;
    protected $phone_number;
    protected $therapistRepository;


    public function __construct(CreateTherapistRequest $createTherapistRequest, TherapistRepository $therapistRepository)
    {
        $this->full_name = $createTherapistRequest->getFull_name();
        $this->specialization = $createTherapistRequest->getSpecialization();
        $this->phone_number = $createTherapistRequest->getPhone_number();
        $this->therapistRepository = $therapistRepository;
    }

    public function createTherapist(){
        return $this->therapistRepository->createTherapist($this->full_name, $this->specialization, $this->phone_number);
    }
}