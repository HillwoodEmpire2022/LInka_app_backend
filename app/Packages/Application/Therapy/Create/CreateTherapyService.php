<?php

namespace App\Packages\Application\Therapy\Create;
use App\Packages\Application\Therapy\Create\CreateTherapyRequest;
use App\Packages\Infrastructure\TherapyCategoryRepository;


class CreateTherapyService{

    protected $name;
    protected $coverImage;
    protected $createTherapyRepository;

    public function __construct(CreateTherapyRequest $createTherapyRequest, TherapyCategoryRepository $therapyCategoryRepository)
    {
        $this->name = $createTherapyRequest->getName();
        $this->coverImage = $createTherapyRequest->getCoverImage();

        $this->createTherapyRepository = $therapyCategoryRepository;
    }

    public function createTherapy(){

        return $this->createTherapyRepository->createTherapy($this->name, $this->coverImage);
        
    }
}