<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'email' =>$this->email,
            'etat' =>$this->etat,
            'name' =>$this->name,
            "adress" =>$this->adress,
            "matricule" =>$this->matricule,
            "lieu_id" =>$this->lieu_id,
            "categorie_id" =>$this->categorie_id,
        ];
    }
}
