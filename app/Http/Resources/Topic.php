<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Topic extends JsonResource
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
            'author_name' => $this->author->name,
            'author_id' => $this->author->id,
            'body' => $this->body,
            'created_at' => $this->created_at
        ];
    }
}
