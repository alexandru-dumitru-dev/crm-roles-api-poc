<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{

    private $currentPage = null;
    private $totalPages = null;
    protected $total = null;

    public $collects = UserResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'total' => $this->total,
                'total_pages' => $this->totalPages,
                'current_page' => $this->currentPage,
            ]
        ];
    }

    public function setTotal($total): UserCollection
    {
        $this->total = $total;

        return $this;
    }

    public function setTotalPages($totalPages): UserCollection
    {
        $this->totalPages = $totalPages;

        return $this;
    }

    public function setCurrentPage($currentPage): UserCollection
    {
        $this->currentPage = $currentPage;

        return $this;
    }
}
