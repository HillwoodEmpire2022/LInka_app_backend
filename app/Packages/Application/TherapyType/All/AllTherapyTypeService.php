<?php

namespace App\Packages\application\TherapyType\All;

use App\Packages\Infrastructure\TherapyTypeRepository;

class AllTherapyTypeService{

    protected $therapyTypeRepository;

    public function __construct(TherapyTypeRepository $therapyTypeRepository)
    {
        $this->therapyTypeRepository = $therapyTypeRepository;
    }

    public function allTherapyType(){

        return $this->therapyTypeRepository->getAllTherapyType();
    }
}