<?php

namespace App\Packages\Application\TherapyType\Update;
use App\Packages\Application\TherapyType\Update\UpdateTherapyTypeRequest;
use App\Packages\Infrastructure\TherapyTypeRepository;

class UpdateTherapyTypeService{

    protected $name;
    protected $description;
    protected $id;
    protected $therapyTypeRepository;

    public function __construct(UpdateTherapyTypeRequest $updateTherapyTypeRequest, TherapyTypeRepository $therapyTypeRepository)
    {
        $this->id = $updateTherapyTypeRequest->getID();
        $this->name = $updateTherapyTypeRequest->getName();
        $this->description = $updateTherapyTypeRequest->getDescription();
        $this->therapyTypeRepository = $therapyTypeRepository;
    }

    public function updateTherapyType(){

        return $this->therapyTypeRepository->updateTherapyType($this->id, ['Therapy_name'=>$this->name, 'Description'=>$this->description]);
    }
}