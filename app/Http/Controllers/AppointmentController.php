<?php

namespace App\Http\Controllers;

use App\Packages\Application\Appointment\All\AllAppointmentService;
use App\Packages\Application\Appointment\Create\CreateAppointmentRequest;
use App\Packages\Application\Appointment\Create\CreateAppointmentService;
use App\Packages\Application\Appointment\Delete\DeleteAppointmentService;
use App\Packages\Application\Appointment\Find\FindOneAppointmentService;
use App\Packages\Application\Appointment\Update\UpdateAppointmentService;
use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use App\Packages\Application\Therapy\Update\UpdateTherapyRequest;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    
    public function createAppointment(Request $request ,CreateAppointmentService $createAppointmentService){

        $appointmentRequest = new CreateAppointmentRequest($request);
        return $createAppointmentService->createAppointment($appointmentRequest);

    }

    public function getAllAppointment(AllAppointmentService $allAppointmentService){
        
        return $allAppointmentService->getAllAppointment();

    }

    public function getOneAppointment(Request $request, FindOneAppointmentService $findOneAppointmentService){

        $appointmentRequest = new FindOneTherapyRequest($request);
        return $findOneAppointmentService->findAppointment($appointmentRequest);

    }

    public function updateAppointment(Request $request, UpdateAppointmentService $updateAppointmentService){

        $appointmentRequest = new UpdateTherapyRequest($request);
        return $updateAppointmentService->updateAppointment($appointmentRequest);

    }

    public function deleteAppointment(Request $request, DeleteAppointmentService $deleteAppointmentService){

        $appointmentRequest = new FindOneTherapyRequest($request);
        return $deleteAppointmentService->deleteAppointment($appointmentRequest);
        
    }
}
