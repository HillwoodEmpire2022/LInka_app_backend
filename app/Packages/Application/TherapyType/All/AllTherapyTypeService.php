<?php

namespace App\Packages\Application\Therapist\All\All;

use App\Packages\Infrastructure\TherapistRepository;

class AllTherapyTypeService{

    protected $therapistRepository;

    public function __construct(TherapistRepository $therapistRepository)
    {
        $this->therapistRepository = $therapistRepository;
    }

    public function allTherapist(){

        return $this->therapistRepository->getAllTherapist();
        
    }
}