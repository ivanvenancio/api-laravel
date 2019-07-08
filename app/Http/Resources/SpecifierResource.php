<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecifierResource extends JsonResource
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
            'id' => $this->id,
            'cpf' => $this->cpf,
            'first_name' => $this->first_name ,
            'last_name'  => $this->last_name,
            'profession'  => $this->profession,
            'date_birth'  => $this->date_birth,
            'phone'  => $this->phone,
            'zip_code' => $this->zip_code,
            'state'  => $this->state,
            'city'  => $this->city,
            'offices' => $this->office
        ];
    }
}
