<?php

namespace App\Packages\Application\Therapist\Find;

use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use App\Packages\Infrastructure\TherapistRepository;

class FindOneTherapistService{

    protected $id;
    protected $therapistrepository;

    public function __construct(FindOneTherapyRequest $findOneTherapyRequest, TherapistRepository $therapistRepository)
    {
        $this->id = $findOneTherapyRequest->getID();
        $this->therapistrepository = $therapistRepository;
    }

    public function oneTherapist(){
        return $this->therapistrepository->getOneTherapist($this->id);
    }
}