<?php

namespace App\Packages\Application\TherapyType\Create;
use App\Packages\Application\TherapyType\Create\CreateTherapyTypeRequest;
use App\Packages\Infrastructure\TherapyTypeRepository;

class CreateTherapyTypeService{

    protected $name;
    protected $description;
    protected $therapyTypeRepository;

    public function __construct(CreateTherapyTypeRequest $createTherapyTypeRequest, TherapyTypeRepository $therapyTypeRepository)
    {
        $this->name = $createTherapyTypeRequest->getName();
        $this->description = $createTherapyTypeRequest->getDescription();
        $this->therapyTypeRepository = $therapyTypeRepository;
    }

    public function createTherapyType(){

        return $this->therapyTypeRepository->createTherapyType($this->name, $this->description);
        
    }
}