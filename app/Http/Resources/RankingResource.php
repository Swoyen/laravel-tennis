<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RankingResource extends JsonResource
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
            'date' => $this->date,
            'gender' => $this->gender,
            'type' => $this->type,
            'ranking' => $this->ranking,
            'player' => $this->player,
            'country' => $this->country,
            'age' => $this->age,
            'points' => $this->points,
            'tournaments' => $this->tournaments
        ] ;
    }
}
