<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Game extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'owner' => $this->user_id ? [
                'user_id' => $this->user_id
            ] : null,
            'name' => $this->name,
            'slug' => $this->slug,
            'url' => $this->url,
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
            'image_path' => $this->image_path,
            'approved' => $this->approved,
            'verified' => $this->verified,
            'promoted' => $this->promoted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
