<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSelect2 extends JsonResource
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
            'id'=>$this->id,
            'value'=>$this->name,
            'label' => $this->name,
            'name'=> $this->name,
            'price'=>$this->price,
            'tax'=>$this->tax->toArray()
        ];
    }
}
