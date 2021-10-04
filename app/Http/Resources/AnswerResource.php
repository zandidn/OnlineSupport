<?php

declare(strict_types = 1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'id'         => $this->id,
            'answer'     => $this->answer,
            'question'   => $this->question,
            'user'       => $this->user,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
