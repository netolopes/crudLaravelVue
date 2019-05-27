<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RefrigeranteCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       return [
        'data' => $this->collection->transform(function ($refrigerante){
            return [
                'id' => $refrigerante->id,
                'marca' => $refrigerante->marca,
                'tipo' => $refrigerante->tipo,
                'sabor' => $refrigerante->sabor,
                'litragem' => $refrigerante->litragem,
                'valor_unidade' => $refrigerante->valor_unidade,
                'quantidade' => $refrigerante->quantidade,
            ];
        })
    ];
    }
}
