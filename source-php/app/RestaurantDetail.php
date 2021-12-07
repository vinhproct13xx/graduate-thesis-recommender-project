<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantDetail extends Model
{
    protected $table = 'restaurant_details';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $appends = ['open_time_am','open_time_pm','close_time_am','close_time_pm'];

    protected $fillable =[
        'res_id',
        'street_address',
        'district',
        'city',
        'price',
        'category_id',
        'open_time',
        'close_time',
        'min_price',
        'max_price',
    ];
    public function category(){
        return $this->belongsTo('App\Category','category_id','id');
    }
    public function getOpenTimeAmAttribute(){
        $time = explode('|',$this->open_time);
        $time_am = $time[0];
        $time_am = explode(' - ',$time_am);
        return trim($time_am[0] ?? '');
    }
    public function getCloseTimeAmAttribute(){
        $time = explode('|',$this->open_time);
        $time_am = $time[0];
        $time_am = explode(' - ',$time_am);
        return trim($time_am[1] ?? '');
    }
    public function getOpenTimePmAttribute(){
        $time = explode('|',$this->open_time);
        $rs = '';
        if(isset($time[1])){
            $time_pm = $time[1];
            $time_pm = explode(' - ',$time_pm);
            $rs = trim($time_pm[0]  ?? '');
        }
        return $rs;
    }
    public function getCloseTimePmAttribute(){
        $time = explode('|',$this->open_time);
        $rs = '';
        if(isset($time[1])){
            $time_pm = $time[1];
            $time_pm = explode(' - ',$time_pm);
            $rs = trim($time_pm[1]  ?? '');
        }
        return $rs;
    }
}
