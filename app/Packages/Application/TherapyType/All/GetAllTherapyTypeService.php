<?php

namespace App\Packages\Application\TherapyType\All;

use App\Packages\Infrastructure\TherapistRepository;

class GetAllTherapyTypeService{

    protected $therapistRepository;

    public function __construct(TherapistRepository $therapistRepository)
    {
        $this->therapistRepository = $therapistRepository;
    }

    public function getallTherapist(){

        return $this->therapistRepository->getAllTherapist();
        
    }
}