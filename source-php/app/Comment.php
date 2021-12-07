<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'Id';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'AvgRating',
        'CreatedOnTimeDiff',
        'Description',
        'Owner_id',
        'ResId',
        'Title',
        'TotalLike',
        'TotalPictures',
        'TotalView',
        'Parent_id',
    ];

    public function comment_pictures(){
        return $this->hasMany('App\CommentPicture','CommentId','Id');
    }
    public function customer(){
        return $this->belongsTo('App\Customer','Owner_id','Id');
    }
}
