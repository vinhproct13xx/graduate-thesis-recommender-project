<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $table = 'comment_likes';
    protected $primaryKey = 'Id';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'IdOwner',
        'IdComment',
        'Status',

    ];

//    public function customer(){
//        return $this->belongsTo('App\Customer','Owner_id','Id');
//    }
}
