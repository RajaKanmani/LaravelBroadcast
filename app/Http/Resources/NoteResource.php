<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
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
            'uuid'          => $this->uuid,
            'id'            => $this->id,
            'description'   => $this->description,
            'completed'     => $this->completed,
            'sync'          =>  true,
            'created_at'    => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->diffForHumans(),
            'updated_at'    => Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->diffForHumans()
        ];
    }
}
