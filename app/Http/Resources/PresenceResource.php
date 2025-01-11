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
                        "type" => $this->getTypeLabel(), // Transformation du type                        "date"=>$this->date,
                        "distance"=>$this->distance,
                        "statut"=>$this->statut,
                        "date"=>$this->date,
        ];

        
    }
    /**
     * Retourne "arrivé" si type vaut 1, sinon "départ".
     *
     * @return string
     */
    protected function getTypeLabel()
    {
        return $this->type === 1 ? 'arrivé' : 'départ';
    }
}
