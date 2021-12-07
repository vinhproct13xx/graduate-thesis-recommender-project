<?php

namespace App\Console\Commands;

use App\Category;
use App\Restaurant;
use App\RestaurantDetail;
use App\Scraper\Foody;
use App\TargetCustomer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Crawl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl';

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
        try {
            $res = Restaurant::get(['Id','Url'])->toArray();
            $category = Category::where('status','publish')->get()->keyBy('name')->toArray();
            $crawl = new Foody();
            $data_insert = [];
//            $rs = $crawl->scrape( $res[150]['Url']);
//            echo "<pre>";
//             print_r($value = $res[0]);
//            echo "</pre>";
//            exit();
//            foreach ($res as $key=>$v ){
//                echo_now($key);
            $v= $res[0];
                if(!empty($v['Url'])){
                    $rs = $crawl->scrape($v['Url']);
                    print_r($rs) ;
                    exit();
                    if(count($rs)>0){
                        $rs['category'] = explode(',',$rs['category'])['0'];
                        $data_insert[] = [
                            'res_id' => $v['Id'],
                            'street_address' => $rs['street_address'] ?? '',
                            'district' => $rs['district'] ?? '',
                            'city' => $rs['city'] ?? '',
                            'price' => $rs['price'] ?? '',
                            'category_id' => $category[$rs['category']] ? $category[$rs['category']]['id'] : ''  ,
                            'cuisine_id' => null,
                            'target_customer_id' => null,
                            'open_time' => $rs['open_time'],
                        ];
                    }
                }

//            }
            return
            RestaurantDetail::insert($data_insert);
            echo 'success';
            DB::commit();
        }catch(\Exception $e){
            echo $e;
            DB::rollBack();
        }
    }
}
