<?php

namespace App\Http\Controllers\Api\Category;

use App\Category;
use App\Comment;
use App\CommentLike;
use App\CommentPicture;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\ChangePasswordRequest;
use App\Http\Requests\Account\LoginRequest;
use App\Http\Requests\Account\RegisterRequest;
use App\Http\Requests\Comment\CreateCommentRequest;
use App\Report;
use App\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Mockery\Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class CategoryController extends Controller
{
   public function getList(Request $request){
       $categories = Category::where('status',1)->get();
       return [
           'success' => true,
           'data' => $categories
       ];
   }
}
