<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
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
            'cnpj' => $this->cnpj,
            'fantasy_name' => $this->fantasy_name,
            'social_name'  => $this->social_name,
            'zip_code' => $this->zip_code,
            'specifiers' => $this->specifier
        ];
    }
}
