<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranResourse extends JsonResource
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
            'title'=> $this->name,
            'models' => $this->models->map(function ($model) {
                return [
                    'id'=>$model->id,
                    'name'=>$model->name,
                    'Categories' => $model->categories->map(function ($categorie) {
                        return [
                            'id'=>$categorie->id,
                            'name'=>$categorie->name,
                        ];
                    })->toArray()
                ];
            })->toArray(),
            'cars_count' => $this->cars->count(), // Directly count the related cars

         ];
    }
}
