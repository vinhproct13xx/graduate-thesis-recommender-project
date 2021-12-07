<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';
    protected $primaryKey = 'Id';
    public $incrementing = true;
    public $timestamps = false;
    protected $appends = ['name_summary','address_summary'];
    protected $fillable = [
        'Address',
        'AvgRating',
        'Description',
        'Distance',
        'IsOpening',
        'Latitude',
        'Longitude',
        'Name',
        'Status',
        'IsFoody',
        'PositionRating',
        'PriceRating',
        'QualityRating',
        'ServiceRating',
        'SpaceRating',
        'PriceMax',
        'PriceMin',
        'PhotoUrl',
        'Owner_id',
    ];

    public function restaurant_detail(){
        return $this->belongsTo('App\RestaurantDetail','Id','res_id');
    }

    public function getNameSummaryAttribute(){
        $name = str_split($this->Name);
        $name = array_splice($name,0,34);
        $name = implode('',$name);
        $name .= '...';
        return mb_convert_encoding($name,'UTF-8', 'UTF-8');
    }
    public function getAddressSummaryAttribute(){
        $address = str_split($this->Address);
        $address = array_splice($address,0,39);
        $address = implode('',$address);
        $address .= '...';
        return mb_convert_encoding($address,'UTF-8', 'UTF-8');
    }
}
