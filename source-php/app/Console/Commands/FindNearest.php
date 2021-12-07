<?php

namespace App\Console\Commands;

use App\Restaurant;
use Illuminate\Console\Command;

class FindNearest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nearest';

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
        echo route('api.res.nearest');
        exit();
        $a =['red','blue','yellow','black'];
        print_r(array_slice($a, 9, 2));
        exit();
        $res = Restaurant::all()->toArray();
        foreach ($res as $key=>$value) {
            $res[$key]['distance'] = haversine($from_location, $value);
        }
        usort($res,function ($a, $b){
            if ($a['distance'] == $b['distance']) {
                return 0;
            }
            return ($a['distance'] < $b['distance'])?-1:1;
        });
        print_r(array_slice($res, (2*3 -3), 3));
    }
}
