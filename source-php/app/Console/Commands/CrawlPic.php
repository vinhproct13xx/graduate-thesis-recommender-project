<?php

namespace App\Console\Commands;

use App\CommentPicture;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CrawlPic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawlPic';

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
            $pics = CommentPicture::whereNotNull('PhotoDetailUrl')->get();
            $i=1;
            foreach ($pics as $pic){
                echo_now($i.'-'.$pic['Id']);
                $path = 'Images/'.$pic['CommentId'].'-'.$pic['Id'].'-'.time().'.jpg';
                file_put_contents(public_path($path), file_get_contents($pic['Url']));
                $pic->update(['Url'=>$path]);
                $i++;
            }
            DB::beginTransaction();

        }catch (\Exception $e){
            DB::rollBack();
            echo_now($e);
        }

        echo "<pre>";
         print_r($value = $pics[0]['Height']);
        echo "</pre>";
        exit();
    }
}
