<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $attachmentsData = $this->attachments->map(function ($attachment) {
        //     return [
        //         'name' => $attachment->name,
        //         'mime' => $attachment->mime,
        //         'path' => $attachment->path,
        //         'size' => $attachment->size,
        //         // Add any other properties you want to include
        //     ];
        // });

        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'firstName'=>$this->firstName,
            'lastName'=>$this->lastName,
            'nickName'=>$this->nickName,
            'age'=>$this->age,
            'gender'=>$this->gender,
            'country'=>$this->country,
            'height'=>$this->height,
            'weight'=>$this->weight,
            'personalInfo'=>$this->personalInfo,
            'sexualOrientation'=>$this->sexualOrientation,
            'lookingFor'=>$this->lookingFor,
            'lookingDescription'=>$this->lookingDescription,
            'profileImagePath_url'=>$this->profileImagePath ? :null,
            'image_mime'=>$this->image_mime,
            'image_size'=>$this->image_size,
            'deleted_by'=>$this->deleted_by,
            'deleted_at'=>$this->deleted_at,
            'num_of_reactions'=>$this->reactions_count
        ];
    }
}
