<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UtityController extends Controller
{
    public function uploadImage(Request $request)
    {
        try {
            if (!isset($request->image)) {
                return [
                    'success' => false,
                    'message' => 'Vui lòng chọn hình'
                ];
            }
            $ext = $request->image->getClientOriginalExtension();
            if (!in_array(strtolower($ext), ['jpg', 'png'])) {
                return [
                    'success' => false,
                    'message' => 'File không đúng định dạng'
                ];
            }
            $path ='upload';
            if(isset($request->folder)){
                $path .= '/'.$request->folder;
            }
            $rs = uploadFile(['path' => $path, 'file' => $request->image]);
            return $rs;
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function removeImage(Request $request){
        return removeFile(['path'=>$request->path]);
    }
}
