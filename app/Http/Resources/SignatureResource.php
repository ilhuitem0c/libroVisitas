<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SignatureResource extends JsonResource
{
    /**
     * Transforma el resource a un array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => $this->avatar,
            'body' => $this->body,
            'date' => $this->created_at->diffForHumans()
        ];
    }
}
