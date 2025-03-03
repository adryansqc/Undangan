<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UndanganCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     'data' => $this->collection,
        //     'links' => [
        //         'self' => 'link-value',
        //     ],
        // ];
        return [
            'data' => $this->collection,
            'meta' => [
                'total' => $this->resource->total(),
                'count' => $this->resource->count(),
                'per_page' => $this->resource->perPage(),
                'current_page' => $this->resource->currentPage(),
                'last_page' => $this->resource->lastPage(),
            ],
        ];

        // return [
        //     'data' => $this->collection,
        //     'meta' => [
        //         'current_page' => $this->resource->currentPage(),
        //         'last_page' => $this->resource->lastPage(),
        //         'total' => $this->resource->total(),
        //         'per_page' => $this->resource->perPage(),
        //         'count' => $this->resource->count(),
        //     ],
        //     'links' => [
        //         'first' => $this->resource->url(1),
        //         'last' => $this->resource->url($this->resource->lastPage()),
        //         'prev' => $this->resource->previousPageUrl(),
        //         'next' => $this->resource->nextPageUrl(),
        //     ]
        // ];

        // return [
        //     'data' => $this->collection->map(function ($item) {
        //         return [
        //             'id' => $item->id,
        //             'nama' => $item->nama,
        //             'pronoun' => $item->pronoun,
        //             'slug' => $item->slug,
        //             // 'created_at' => $item->created_at->format('d-m-Y H:i:s'),
        //             // 'updated_at' => $item->updated_at->format('d-m-Y H:i:s'),
        //         ];
        //     }),
        //     'meta' => [
        //         'total' => $this->resource->total(),
        //         'count' => $this->resource->count(),
        //         'per_page' => $this->resource->perPage(),
        //         'current_page' => $this->resource->currentPage(),
        //         'last_page' => $this->resource->lastPage(),
        //     ],
        // ];
    }
}
