<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PresenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            
                        "id"=>$this->id,
                        "utilisateur_id"=>$this->utilisateur_id,
                        "type"=>$this->type,
                        "date"=>$this->date,
                        "distance"=>$this->distance,
                        "statut"=>$this->statut,
        ];
    }
}
