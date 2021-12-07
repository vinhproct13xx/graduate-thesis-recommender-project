<?php

namespace App\Console\Commands;

use App\Similarity;
use Illuminate\Console\Command;

class RunAl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'runal';

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
        $create_date = Similarity::first();
        $create_date = strtotime($create_date['created']);
        $current_date = date('Y-m-d',time());
        $sub = (time() - $create_date);
//        echo $sub;
        echo $sub/(86400);
        exit();
//        echo $create_date->diff($current_date);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://recommender-2oclock.herokuapp.com/polls/go?query=qu%C3%A1n%20n%C3%A0o%20g%E1%BA%A7n%20%C4%91%C3%A2y%20kh%C3%B4ng',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo 123;

    }
}
