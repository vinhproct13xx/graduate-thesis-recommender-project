<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use DOMDocument;
class CreateXmlController extends Controller
{
    public function create(){
        $res  = Restaurant::first();
        $res->name = 'hehe';
        $res->save();




        function parseToXML($htmlStr)
        {
            $xmlStr=str_replace('<','&lt;',$htmlStr);
            $xmlStr=str_replace('>','&gt;',$xmlStr);
            $xmlStr=str_replace('"','&quot;',$xmlStr);
            $xmlStr=str_replace("'",'&apos;',$xmlStr);
            $xmlStr=str_replace("&",'&amp;',$xmlStr);
            return $xmlStr;
        }
        header("Content-type: text/xml");
        $xmlStr = '';
        $xmlStr.= '<markers>';
        $res = Restaurant::take(10)->get()->toArray();
        foreach ($res as $value){
            $xmlStr.= '<marker ';
            $xmlStr.= 'id="' . parseToXML( $value['Id']) . '" ';
            $xmlStr.= 'name="' . parseToXML( $value['Name']) . '" ';
            $xmlStr.= 'address="' . parseToXML($value['Address']) . '" ';
            $xmlStr.= 'lat="' . $value['Latitude'] . '" ';
            $xmlStr.= 'lng="' . $value['Longitude'] . '" ';
            $xmlStr.= 'type="restaurant" ';
            $xmlStr.= '/>';
        }
        $xmlStr.= '</markers>';
        file_put_contents(public_path('ggmap.xml'),$xmlStr);
        echo 111;
    }

    public function hehe(Request $request){
        $data = \request()->all();
        return $data;
    }
}
