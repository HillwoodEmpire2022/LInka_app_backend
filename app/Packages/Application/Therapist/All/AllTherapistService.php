<?php

namespace App\Packages\Application\Therapist\All;

use App\Packages\Infrastructure\TherapistRepository;

class AllTherapistService{

    protected $therapistrepository;

    public function __construct(TherapistRepository $therapistRepository)
    {
        $this->therapistrepository = $therapistRepository;
    }

    public function allTherapist(){
        return $this->therapistrepository->getAllTherapist();
    }
}