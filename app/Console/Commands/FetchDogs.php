<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Dog;

class FetchDogs extends Command
{
    /**
     * The name and <?php
     *
     * namespace App\Console\Commands;
     *
     * use Illuminate\Console\Command;
     * use Illuminate\Support\Facades\Http;
     * use App\Models\Dog;
     *
     * class FetchDogs extends Command
     * {
     * protected $signature = 'fetch:dogs';
     * protected $description = 'Fetch dog breeds and store in database';
     *
     * public function handle()
     * {
     * $response = Http::get('https://dog.ceo/api/breeds/list/all');
     *
     * if ($response->failed()) {
     * $this->error('Failed to fetch breeds');
     * return 1;
     * }
     *
     * $breeds = $response->json('message');
     *
     * foreach ($breeds as $breed => $subBreeds) {
     * if (count($subBreeds) > 0) {
     * foreach ($subBreeds as $sub) {
     * $name = "$sub $breed";
     * $imageResponse = Http::get("https://dog.ceo/api/breed/$breed/$sub/images/random");
     * $image = $imageResponse->json('message') ?? '';
     * Dog::updateOrCreate(
     * ['breed' => $name],
     * ['image_url' => $image]
     * );
     * }
     * } else {
     * $imageResponse = Http::get("https://dog.ceo/api/breed/$breed/images/random");
     * $image = $imageResponse->json('message') ?? '';
     * Dog::updateOrCreate(
     * ['breed' => $breed],
     * ['image_url' => $image]
     * );
     * }
     * }
     *
     * $this->info('Dogs fetched and stored successfully.');
     * return 0;
     * }
     * }
     * signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-dogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://dog.ceo/api/breeds/list/all');
        $breeds = array_keys($response->json()['message']);

        foreach ($breeds as $breed) {
            $image = Http::get("https://dog.ceo/api/breed/{$breed}/images/random")->json()['message'];
            Dog::updateOrCreate(['breed' => $breed], ['image_url' => $image]);
        }

        $this->info('Dogs fetched successfully!');
    }
}
