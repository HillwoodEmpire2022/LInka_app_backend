<?php

namespace App\Packages\Application\Therapy\All;
use App\Packages\Infrastructure\TherapyCategoryRepository;



class AllTherapyService{

    protected $therapyCategoryRepository;

    public function __construct(TherapyCategoryRepository $therapyCategoryRepository)
    {

        $this->therapyCategoryRepository = $therapyCategoryRepository;

    }

    public function allTherapy(){

        return $this->therapyCategoryRepository->getAll();
        
    }
}