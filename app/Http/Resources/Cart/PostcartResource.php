<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostcartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       

        return [
            'id' => $this->id,
            'master_service_id' => $this->masterServiceId,
            'type' => 'postcard',
            'isRate' => $this->isRate,
            'rate' => $this->rate,
            'title_ar' => $this->subOptions->sizeOrtype->title_ar,
            'title_en' => $this->subOptions->sizeOrtype->title_en,
            'description_ar' => $this->subOptions->description_ar,
            'description_en' => $this->subOptions->description_en,
            'copies' => $this->copies,
            'photo_num' => $this->photo_num,
            'people_num' => null,
            'quantity' => null,
            'note_user' => $this->note,
            'note_app_ar' => ' سيتم حذف الصور بعد 3 أيام من الاستلام',
            'note_app_en' => 'Photos will be deleted 3 days after receipt',
            'total' => [
                'val' => number_format($this->totalService,2,'.',''),
                'currency' => $this->subOptions->currencyKey,
            ],
            'images_count' => $this->images->count(),
            'images' => $this->images->map(function($e){
                return Storage::url($e->path);
            }),
        ];
    }
}
