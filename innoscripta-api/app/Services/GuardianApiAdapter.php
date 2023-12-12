<?php

namespace App\Services;

use App\Interfaces\NewsApiInterface;
use App\Models\Source;
use Carbon\Carbon;
use GuzzleHttp\Client;

class GuardianApiAdapter implements NewsApiInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchNews(): array
    {

        // Make the API request using the Guzzle HTTP client
        $response = $this->client->get("https://content.guardianapis.com/search?q=body&format=json&tag=film/film,tone/reviews&show-tags=contributor&show-refinements=all&order-by=relevance&show-blocks=body&show-fields=thumbnail&api-key=".config('sources.guardian_api.key'));

        // Transform the response data as per your requirement
        $data = json_decode($response->getBody(), true);

        foreach ($data['response']['results'] as $item){

            Source::create([
                'reference'=>Source::REFERENCE_GUARDIAN,
                'title'=>$item['tags'][0]['webTitle'],
                'category'=>$item['sectionName'],
                'author'=>$item['tags'][0]['firstName'].' '.$item['tags'][0]['lastName'],
                'content'=>$item['blocks']['body'][0]['bodyTextSummary'],
                'image'=>$item['fields']['thumbnail'],
                'published_at'=>Carbon::parse($item['webPublicationDate'])
            ]);
        }

        return $data;
    }
}
