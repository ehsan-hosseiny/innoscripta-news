<?php

namespace App\Services;

use App\Interfaces\NewsApiInterface;
use App\Models\Source;
use Carbon\Carbon;
use GuzzleHttp\Client;

class NewsApiAdapter implements NewsApiInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchNews(): array
    {
        // Make the API request using the Guzzle HTTP client

        $response = $this->client->get("https://newsapi.org/v2/everything?q=all&apiKey=".config('sources.news_api.key'));

        // Transform the response data as per your requirement
        $data = json_decode($response->getBody(), true);
        foreach($data['articles'] as $item){
//            if(!is_null($item['urlToImage']) && !is_null($item['author'])){
                Source::create([
                    'reference'=>Source::REFERENCE_NEWS_API,
                    'title'=>$item['title'],
                    'category'=>$item['source']['name'],
                    'author'=>$item['author'],
                    'content'=>$item['description'],
                    'image'=>$item['urlToImage'],
                    'published_at'=>Carbon::parse($item['publishedAt'])
                ]);
//            }
        }


        return $data;
    }
}
