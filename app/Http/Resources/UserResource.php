<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'role' => $this->role,
            'user_status' => $this->user_status,
            'name' => $this->name,
            'emp_id' => $this->emp_id,
            'designation' => $this->designation,
            'date of birth' => $this->dob,
            'emp_grade' => $this->emp_grade,
            'date of joining' => $this->doj,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
