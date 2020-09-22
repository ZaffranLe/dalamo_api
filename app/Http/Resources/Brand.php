<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class Brand extends JsonResource
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
            'name' => $this->name,
            'imagrUrl' => $this->imagrUrl,
            'createdBy' => $this->createdBy,
            'createdDate' => $this->createdDate,
            'updatedBy' => $this->updatedBy,
            'updatedDate' => $this->updatedDate,
            'deletedBy' => $this->deletedBy,
            'deletedDate' => $this->deletedDate,
            'isDeleted' => $this->isDeleted
        ];
    }
}
