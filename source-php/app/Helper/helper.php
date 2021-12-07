<?php
use Illuminate\Support\Facades\Mail;

function normalizing($owner_row = null){
    $array_filter = array_filter($owner_row,function($rating){
        return $rating != '-';
    });

    $avg = array_sum($array_filter)/count($array_filter);
    $avg = round($avg,2);
    $owner_row = array_map(function($rating) use($avg){
        return ($rating == '-') ? '-' : ($rating - $avg);
    }, $owner_row);

    return $owner_row;

}
function echo_now($s)
{
    echo $s . PHP_EOL;

    flush();
}
function calculateDistance($destinations = '', $origin = ''){
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 0,
        CURLOPT_URL => 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$origin.'&destinations='.$destinations.'&key=AIzaSyCzlVX517mZWArHv4Dt3_JVG0aPmbSE5mE',
        CURLOPT_USERAGENT => '',
        CURLOPT_SSL_VERIFYPEER => false
    ));

    $resp = curl_exec($curl);

    $weather = json_decode($resp);
    var_dump($weather);

    curl_close($curl);
}
function sendEmail($data = [])
{
    try {
        $data['from'] = config('mail.from.address');
        if (isset($data['cc']) && !empty($data['cc'])) {
            Mail::send($data['view'], $data['information'], function ($messages) use ($data) {
                $messages->from($data['from'], config('mail.from.name'));
                $messages->to($data['to'])
                    ->bcc($data['cc'])
                    ->subject($data['subject']);
            });
        } else {
            Mail::send($data['view'], $data['information'], function ($messages) use ($data) {
                $messages->from($data['from'], config('mail.from.name'));
                $messages->to($data['to'])
                    ->subject($data['subject']);
            });
        }
        return [
            'success' => true,
            'message' => __('please_check_email_at', ['email' => $data['to']])
        ];
    } catch (\Exception $exception) {

        return [
            'success' => false,
            'message' => $exception->getMessage(),
        ];
    }

}
if (!function_exists('_trans')) {
    /**
     * Translate the given message.
     *
     * @param string|null $key
     * @param array $replace
     * @param string|null $locale
     * @return string|array|null
     */
    function _trans($default = null, $key = null, $replace = [], $locale = null)
    {
        if (is_null($key)) {
            return $default;
        }

        return trans($key, $replace, $locale);
    }
}
function haversine($from_location, $to_location ){
    $earthRadius = 6371000;
    $lat1 = deg2rad($from_location['Latitude']);
    $lon1 = deg2rad($from_location['Longitude']);
    $lat2 = deg2rad($to_location['Latitude']);
    $lon2 = deg2rad($to_location['Longitude']);

    $delta_lat = $lat2 - $lat1;
    $delta_lng = $lon2 - $lon1;

    $hav_lat = (sin($delta_lat / 2))**2;
    $hav_lng = (sin($delta_lng / 2))**2;

    $distance = 2 * asin(sqrt($hav_lat + cos($lat1) * cos($lat2) * $hav_lng));
    $distance = ($distance * $earthRadius)/1000;
    return round($distance,3);
}
function uploadFile($data = [])
{
    try {
        $path = isset($data['path']) ? $data['path'] : '/';
        if (!is_dir(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }
        if (!empty($data['file'])) {
            $args['name'] = str_replace(" ", "_", $data['file']->getClientOriginalName());
            $args['size'] = str_replace(" ", "_", $data['file']->getSize());
            $args['ext'] = str_replace(" ", "_", $data['file']->getClientOriginalExtension());
            $args['type'] = str_replace(" ", "_", $data['file']->getMimeType());
            $filename = date('YmdHis') . '_' . $args['name'];
            $args['path'] = $path . '/' . $filename;
            $data['file']->move($path, $filename);
            return [
                'success' => true,
                'data' => $args
            ];
        }
        return [
            'success' => false,
            'message' => __('file_is_not_exist')
        ];

    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => $e->getMessage()
        ];
    }
}

function removeFile($data = [])
{
    try {
        if (!empty($data['path']) && file_exists(public_path($data['path']))) {
            unlink(public_path($data['path']));
            return [
                'success' => true,
                'message' => 'Xóa file thành công'
            ];
        }
        return [
            'success' => false,
            'message' => __('file_is_not_exist')
        ];
    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => $e->getMessage()
        ];
    }
}
function curlApi($url, $param = [], $method = 'POST')
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => json_encode($param),
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

