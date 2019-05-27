<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RefrigeranteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       return [
        'marca' => $this->marca,
        'tipo' => $this->tipo,
        'sabor' => $this->sabor,
        'litragem' => $this->litragem,
        'valor_unidadae' => $this->valor_unidadae,
        'quantidade' => $this->quantidade,
    ];
    }
}
