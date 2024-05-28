<?php

namespace App\Packages\Application\TherapyType\Delete;

use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use App\Packages\Infrastructure\TherapyTypeRepository;

class DeleteTherapyTypeService{

    protected $id;
    protected $therapyrepository;

    public function __construct(FindOneTherapyRequest $findOneTherapyRequest, TherapyTypeRepository $therapyTypeRepository)
    {
        $this->id = $findOneTherapyRequest->getID();
        $this->therapyrepository = $therapyTypeRepository;
    }

    public function deleteTherapyType(){

        return $this->therapyrepository->deleteTherapyType($this->id);
        
    }
}