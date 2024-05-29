<?php

namespace App\Packages\Application\Therapist\Delete;

use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use App\Packages\Infrastructure\TherapistRepository;

class DeleteTherapistService{

    protected $id;
    protected $therapistrepository;


    public function __construct(FindOneTherapyRequest $findOneTherapyRequest, TherapistRepository $therapistRepository)
    {
        $this->id = $findOneTherapyRequest->getID();
        $this->therapistrepository = $therapistRepository;
    }

    public function deleteTherapist(){
        return $this->therapistrepository->deleteTherapist($this->id);
    }
}