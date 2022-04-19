<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class Team extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
