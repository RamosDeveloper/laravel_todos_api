<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
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
            'task' => $this->task,
            'is_done' => (bool)$this->is_done,
            'user' => $this->user,
            'created_at' => \Carbon\Carbon::parse($this->created_at)->toDateString(),
            'updated_at' => \Carbon\Carbon::parse($this->updated_at)->toDateString(),
        ];
    }
}
