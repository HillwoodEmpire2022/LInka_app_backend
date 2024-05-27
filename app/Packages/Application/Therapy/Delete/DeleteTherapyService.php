<?php

namespace App\Packages\Application\Therapy\Delete;
use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use App\Packages\Infrastructure\TherapyCategoryRepository;

class DeleteTherapyService{

    protected $id;
    protected $therapyCategoryRepository;


    public function __construct(FindOneTherapyRequest $findOneTherapyRequest, TherapyCategoryRepository $therapyCategoryRepository)
    {
        $this->id = $findOneTherapyRequest->getID();
        $this->therapyCategoryRepository = $therapyCategoryRepository;
    }

    public function deleeteTherapy(){

        return $this->therapyCategoryRepository->deleteTherapy($this->id);

    }
}