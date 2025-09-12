<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    private $uptdType;

    public function __construct($resource, $uptdType = null)
    {
        parent::__construct($resource);
        $this->uptdType = $uptdType;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'jenis_ikan_id' => $this->jenis_ikan_id,
            'user_id' => $this->user_id,
            'unit' => $this->unit,
            'size' => $this->size,
            'spelled' => $this->spelled,
            'is_active' => $this->is_active,
        ];

        // Conditionally show/hide attributes based on UPTD type
        if ($this->uptdType == 1) {
            $data['retribution'] = $this->retribution;
        } elseif ($this->uptdType == 2) {
            $data['price'] = $this->price;
        } else {
            $data['price'] = $this->price;
            $data['retribution'] = $this->retribution;
        }

        $data['jenis_ikan'] = [
            'id' => $this->jenis_ikan->id,
            'name' => $this->jenis_ikan->name,
            'type' => $this->jenis_ikan->type,
            'economic_value' => $this->jenis_ikan->economic_value,
            'imageUrl' => $this->jenis_ikan->imageUrl
        ];

        return $data;
    }

    /**
     * Create a custom collection with uptdType
     */
    public static function collectionWithUptdType($resource, $uptdType)
    {
        return $resource->map(function ($item) use ($uptdType) {
            return new static($item, $uptdType);
        });
    }
}
