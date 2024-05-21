<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
{
public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password,
            'avatar_url'=>$this->avatar_url,
            'avatar_url'=>$this->avatar_path,
            'cover_url'=>$this->cover_path,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}
