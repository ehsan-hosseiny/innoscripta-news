<?php

namespace App\Services;


use App\Interfaces\NewsApiInterface;
use App\Models\Source;
use Carbon\Carbon;
use GuzzleHttp\Client;

class NyTimesApiAdapter implements NewsApiInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchNews(): array
    {

        // Make the API request using the Guzzle HTTP client
        $response = $this->client->get("https://api.nytimes.com/svc/search/v2/articlesearch.json?q=all&api-key=".config("sources.nyt_api.key"));


        // Transform the response data as per your requirement
        $data = json_decode($response->getBody(), true);

        foreach ($data['response']['docs'] as $item){
            if($item['document_type'] != 'multimedia'){
                $multimedia = $item['multimedia'][0] ?? null; // Assuming the first multimedia item is the thumbnail
                $image = null;
                if ($multimedia && isset($multimedia['url'])) {
                    $baseURL = 'https://www.nytimes.com/';
                    $image = $baseURL . $multimedia['url'];
                }
                //--we can add another table for store all images
                Source::create([
                    'reference'=>Source::REFERENCE_NEW_YORK_TIMES,
                    'title'=>$item['headline']['main'],
                    'category'=>$item['news_desk'],
                    'author'=>$item['byline']['original'],
                    'content'=>$item['lead_paragraph'],
                    'image'=>$image,
                    'published_at'=>Carbon::parse($item['pub_date'])
                ]);
            }
        }
        return $data;
    }
}
