<?php

namespace App\Packages\Application\TherapyType\Find;
use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use App\Packages\Infrastructure\TherapyTypeRepository;

class FindOneTherapyTypeService{

    protected $id;
    protected $therapyRepository;

    public function __construct(FindOneTherapyRequest $findOneTherapyRequest, TherapyTypeRepository $therapyTypeRepository)
    {
        $this->id = $findOneTherapyRequest->getID();
        $this->therapyRepository = $therapyTypeRepository;
    }

    public function findOneTherapyType(){

        return $this->therapyRepository->getOneTherapyType($this->id);
        
    }
}