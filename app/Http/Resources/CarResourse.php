<?php

namespace App\Http\Resources;

use App\Enums\CarStatus;
use App\Models\CarOrder;
use App\Models\Favorite;
use App\Models\Order;
use Auth;
use DB;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $statue=CarStatus::from($this->status)->name;
        $order = Order::where('car_id', $this->id)->get();
       

        $financeOrdersCountPerCar = $order->where('orderDetailsCar', function ($query) {
             $query->where('payment_type', 'finance');
        })->count();

        $orderCount=$order->count();

        $fav = Favorite::where('car_id', $this->id)
        ->where(function ($query) {
            $query->where(function ($subquery) {
                // Check if the user is logged in
                if (Auth::check()) {
                    $subquery->where('vendor_id', Auth::user()->id);
                } else {
                    // If not logged in, use the IP address
                    $subquery->where('device_ip', request()->ip());
                }
            });
        })
        ->exists();     
        return [
            'id' => $this->id,
            'title'=> $this->name,
            'CarName'=>$this->name_ar,
            'main_title' => $this->brand->name.' '.$this->model->name.' '.$this->year,
            'description'=> getLocale() == 'ar' ? $this->description_ar : $this->description_en ,
            'publish_date'=>$this->created_at->format('Y-m-d '),
            'statue'=>$this->is_new == 1?__('New')  :__('Used') ,
            'statuekey'=>$this->is_new,
            'kilometer'=>$this->kilometers,
            'main_image'=>getImagePathFromDirectory($this->main_image,'Cars'),
            'fuel_type'=>__($this->fuel_type),
            'fuel_typekey'=>$this->fuel_type,
            'gear_shifter'=>__($this->gear_shifter),
            'gear_shifterkey'=>$this->gear_shifter,
            'is_fav'=> $fav,
            'year'=>$this->year,
            'price'=>$this->price,
            'supplier'=>__($this->supplier),
            'supplier_english'=>$this->supplier,
            'have_discount'=>$this->have_discount,
            'video_url'=>$this->video_url,
            'discount_price'=>$this->discount_price,
            'discount_percentage' => $this->discount_price != 0 ? round(($this->price - $this->discount_price) / $this->price * 100, 2): 0,
            'selling_price'=>$this->getSellingPriceAttribute(),
            'tax'=>settings()->getSettings('maintenance_mode') == 1 ? settings()->getSettings('tax') : 0,

            'price_after_tax' => $this->getPriceAfterVatAttribute(),
            'statusCar' => intval($this->status),
            'show_in_home_page' => (bool) $this->show_in_home_page,
            'car_style'=>$this->car_body,
            'fuel_tank_capacity'=>$this->fuel_tank_capacity,
            'vendor' => [
                'id' => $this->vendor->id??null,
                'name' => $this->vendor->name??null,
                'type'=>$this->vendor->type??null,
                'image' => getImagePathFromDirectory($this->vendor->image??null, 'Vendors'),
                'phone' => $this->vendor->phone??null,
                'city' => $this->vendor->city??null,
                'whatsapp_link' => generateWhatsAppLink($this->vendor->phone??null, $this->vendor->name??null),
            ],
            'brand' => [
                'id' => $this->brand->id,
                'title'=>$this->brand->name,
                "image"=> $this->brand->image,
                "cover"=> $this->brand->cover,
                'car_available_types'=>$this->brand->car_available_types
            ],
            'model' => [
                'id' => $this->model->id,
                'title'=>$this->model->name,
            ],
            'categories' => [
                'id' => $this->category->id??"",
                'title'=>$this->category->name??"",
            ],
            'city' => [
                'id' => $this->city->id,
                'title'=>$this->city->name,
            ],
        
            'color' => [
                'id'=>$this->color->id,
                'title'=>$this->color->name,
            ],
            'reports'=>[
                'viewers'=>$this->viewers,
                'financerequests'=>$financeOrdersCountPerCar,
                'Orders'=>$orderCount,
            ],
            'images_ads' => $this->images->map(function ($image) {
                return [
                    'url' => getImagePathFromDirectory($image->image, 'Cars'),
                    'id' => $image->id
                ];
            })->toArray(),

            'images' => $this->images->map(function ($image) {
                return getImagePathFromDirectory($image->image, 'Cars');
            })->toArray()
            
        ];
    }
}
