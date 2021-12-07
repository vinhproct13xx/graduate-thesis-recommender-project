<?php

namespace App\Console\Commands;

use App\Restaurant;
use App\RestaurantDetail;
use Illuminate\Console\Command;

class UpdateTimeAndPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'time_price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        echo asset('a');
        exit();
//        $s = "1:00";
//        $e = "2:00";
////        echo strtotime()
//        echo strtotime($s) - strtotime($e);
//        exit();

        $res_details = RestaurantDetail::all();
        foreach ($res_details as $detail){
//            print_r(explode('|',$detail['open_time']));
//            exit();
//            if(!empty($detail['price'])){
//                $regex_price = preg_match('/(.*)đ - (.*)đ/', $detail['price'], $output_array);
//                if($regex_price){
//                    $min = explode('.',$output_array[1]);
//                    $min= implode('',$min);
//                    $max = explode('.',$output_array[2]);
//                    $max= implode('',$max);
//                    $detail->update([
//                        'min_price'=>$min,
//                        'max_price'=>$max,
//                    ]);
//                }
//            }
            if(!empty($detail['open_time'])){
                $data_update = [];
                $time = explode('|',$detail['open_time']);
                $time_am = $time[0];
                $time_am = explode(' - ',$time_am);
                $data_update = [
                    'open_time_am' => trim($time_am[0] ?? ''),
                    'close_time_am' => trim($time_am[1]?? ''),
                ];
                if(isset($time[1])){
                    $time_pm = $time[1];
                    $time_pm = explode(' - ',$time_pm);
                    $data_update['open_time_pm'] =  trim($time_pm[0]  ?? '');
                    $data_update['close_time_pm'] =  trim($time_pm[1] ?? '');
                }
                $detail->update($data_update);
            }
        }
        echo 'OK';

    }
}
