<?php
namespace App\Scraper;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
Class Foody{
    public function scrape($path){
        $url = "https://www.foody.vn". $path;
        $client = new Client();
        $crawler = $client->request('GET',$url);
//        return $crawler;
        $rs = [];
        return  ($crawler->filter('div.img a img'));
        if(count($crawler->filter('div.res-common-add')->nodes)==0
        || count($crawler->filter('div.res-common-minmaxprice')->nodes)==0
        || count($crawler->filter('div.micro-timesopen')->nodes)==0){
            return [];
        }
        $address_elements =  $crawler->filter('div.res-common-add')->children();
        $address_elements = $address_elements->nodes;

        $price_elements =  $crawler->filter('div.res-common-minmaxprice')->children();
        $price_elements = $price_elements->nodes;

        $category_elements =  $crawler->filter('div.category-items')->children();
        $category_elements = $category_elements->nodes;

//        $cuisine_elements =  $crawler->filter('div.category-cuisines')->children();
//        $cuisine_elements = $cuisine_elements->nodes;

        $time_elements =  $crawler->filter('div.micro-timesopen')->children()->nodes;

        $rs = [
            'street_address'=> trim($address_elements[1]->textContent),
            'district'=> $address_elements[3]->textContent,
            'city'=> $address_elements[4]->textContent,
            'price'=> trim($price_elements[1]->textContent),
            'category'=> trim($category_elements[0]->textContent),
//            'cuisine'=> trim($cuisine_elements[1]->textContent),
//            'target_customer'=> isset($cuisine_elements[2]->textContent) ? trim($cuisine_elements[2]->textContent) : '',
            'open_time' => trim($time_elements[2]->textContent)
        ];
        return $rs;
    }

    public function crawlBranch(){
        $url = "https://www.foody.vn/thuong-hieu/thanh-map-chan-ga-rut-xuong-ngam-sa-tac?c=ho-chi-minh";

        $client = new Client();
        $crawler = $client->request('GET',$url);
        $rs = [];
        $branch =  $crawler->filter('div.ldc-item-h-name')->nodes;

//        $branch = $branch->nodes;
        return $branch;
    }

    public function crawlCategory(){
        $url = 'https://www.foody.vn/them-dia-diem';
        $client = new Client();
        $crawler = $client->request('GET',$url);
        $rs = [];
        $cate =  $crawler->filter('div.detail');
        return $cate;
    }
}
