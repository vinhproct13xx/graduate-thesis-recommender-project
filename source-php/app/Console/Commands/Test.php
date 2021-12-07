<?php

namespace App\Console\Commands;

use App\Comment;
use App\Customer;
use App\Restaurant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

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
//        echo round(5.123,2);
//        exit();
//
//        $str = 'truong dai hoc cong nghe thong tin';
//        $l = strlen($str);
//        print_r(substr($str,0,- ($l - 10)));
//        print_r(substr($str,10,$l-1));

        try {
            DB::beginTransaction();
            exit();
            $descriptions = Comment::whereNotNull('Description')->pluck('Description')->toArray();
//            echo $comments[rand(0,10000)];
            $res_ids = Restaurant::pluck('Id')->toArray();
            $res_ids = array_chunk($res_ids,15);
            $owner_ids = Customer::pluck('Id')->toArray();
            $owner_ids = array_chunk($owner_ids,10);
            foreach ($res_ids as $key=>$res_chunk){
                echo_now($key);
                $owner_chunk = $owner_ids[rand(0,1862)];
                foreach ($res_chunk as $res_id) {
                    foreach ($owner_chunk as $owner_id){
                        Comment::create([
                            'ResId' => $res_id,
                            'Owner_id' => $owner_id,
                            'AvgRating' => rand(1,10),
                            'Description' => $descriptions[rand(1,10000)],
                        ]);
                    }
                }
            }
            echo 'OK';
//            print_r($res_ids[1]);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
    }
}
