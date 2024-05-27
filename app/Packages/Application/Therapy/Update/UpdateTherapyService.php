<?php

namespace App\Packages\Application\Therapy\Update;
use App\Packages\Application\Therapy\Update\UpdateTherapyRequest;
use App\Packages\Infrastructure\TherapyCategoryRepository;


class UpdateTherapyService{

    protected $id;
    protected $name;
    protected $theraphCategoryRepository;

    public function __construct(TherapyCategoryRepository $theraphCategoryRepository, UpdateTherapyRequest $updateTherapyRequest)
    {
        $this->id = $updateTherapyRequest->getID();
        $this->name = $updateTherapyRequest->getName();
        $this->theraphCategoryRepository = $theraphCategoryRepository;
    }

    public function updateTherapy(){

        return $this->theraphCategoryRepository->updateTherapy($this->id, ['Category_name'=>$this->name]);

    }
}