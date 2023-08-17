<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'        => $this->name,
            'surname'     => $this->surname,
            'email'       => $this->email,
            'age'         => $this->age,
            'description' => $this->description,
            'hobby'       => $this->hobby,
            'is_married'  => $this->is_married,
            'created_at'  => $this->created_at->format('Y-m-d'),
        ];
    }
}
