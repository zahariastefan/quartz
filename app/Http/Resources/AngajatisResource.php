<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AngajatisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nume' => $this->nume,
            'prenume' => $this->prenume,
            'departament' => \App\Models\Departamentes::find($this->id_departament)->nume,
            'id_departament' =>\App\Models\Departamentes::find($this->id_departament)->id,
            'descriere_departament' => \App\Models\Departamentes::find($this->id_departament)->descriere,
            'cnp' => $this->cnp  ,
            'functie' => $this->functie,
            'salariu' => $this->salariu,
            'zile_concediu' => $this->zile_concediu,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
