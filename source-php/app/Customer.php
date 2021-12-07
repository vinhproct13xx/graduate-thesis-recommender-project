<?php

namespace App;



use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Customer extends Model implements
    JWTSubject,
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $collection = "customers";
    protected $primaryKey = 'Id';
    public $incrementing = true;

    protected $appends = ['liked'];

    protected $fillable = [
        'Avatar',
        'DisplayName',
        'Username',
        'Google_Id',
        'Status',
        'email',
        'password',
        'Gender',
        'DateOfBirth',
        'CreateAt',
        'UpdateAt',
        'SavedRes',
        'CreateDate',
        'Role',
    ];


    protected $hidden = [
        'password','token'
    ];

    public $timestamps = false;

    public function getLikedAttribute(){
        $comment_likes = CommentLike::where('IdOwner',$this->Id)->pluck('IdComment');
        return !empty($comment_likes) ? $comment_likes->toArray() : [];
    }

    public function comments(){
        return $this->hasMany('App\Comment','Owner_id','Id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
