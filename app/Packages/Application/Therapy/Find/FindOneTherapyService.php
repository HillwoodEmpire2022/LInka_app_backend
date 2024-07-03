<?php

namespace App\Packages\Application\Therapy\Find;
use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use App\Packages\Infrastructure\TherapyCategoryRepository;


class FindOneTherapyService{


    protected $id;
    protected $therapyCategoryRepository;

    public function __construct(TherapyCategoryRepository $therapyCategoryRepository, FindOneTherapyRequest $findOneTherapyRequest)
    {
        $this->id = $findOneTherapyRequest->getID();
        $this->therapyCategoryRepository = $therapyCategoryRepository;
    }

    public function findOneTherapy(){

        return $this->therapyCategoryRepository->getOne($this->id); 
    }
}