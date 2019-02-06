<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'firstname'=>$this->firstname,
            'lastname'=>$this->lastname,
            'joined_year'=>$this->joined_year,
            'gender'=>($this->gender=='M') ? 'Male' : 'Female',
            'teacher'=>$this->teacher->name,
            'class_room'=>$this->classRoom->name
        ];
    }
}
