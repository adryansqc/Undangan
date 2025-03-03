<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UndanganResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'pronoun' => $this->pronoun,
            'slug' => $this->slug,
            // 'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            // 'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),
        ];
    }
}
