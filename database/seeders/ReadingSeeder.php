<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reading;

class ReadingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * These Weather API's and description was generated by ChatGPT in an attempt to find the latest free API's available
     * You are welcome to ask it "give me a list of free weather api's" and see if the same results come up
     * The rest of the url endpoints and tokens where investigated the old way by hand
     * 
     * php artisan db:seed to run
     */

    public function run(): void
    {
        Reading::create([
            'type' => 'OpenWeatherMap',
            'endpoint' => 'http://api.openweathermap.org/data/2.5/weather',
            'token' => 'c7b81ef09624eb9e9497db4a3e31d669',
            'description' => 'One of the most popular weather APIs, offering current weather data, forecasts, and historical data',
            'slug' => 'openweathermap'
        ]);

        Reading::create([
            'type' => 'Weather',
            'endpoint' => '',
            'token' => '',
            'description' => 'Provides access to current weather conditions and forecasts, including hourly and 10-day forecasts',
            'slug' => 'weather'
        ]);

        Reading::create([
            'type' => 'Climacell',
            'endpoint' => '',
            'token' => '',
            'description' => 'Offers hyper-local weather data, including minute-by-minute precipitation forecasts',
            'slug' => 'climacell'
        ]);

        Reading::create([
            'type' => 'Weatherbit',
            'endpoint' => 'https://api.weatherbit.io/v2.0/history',
            'token' => 'e5a4afc70ba54c92aed2153938bac2aa',
            'description' => 'Provides current weather conditions, forecasts, and historical weather data',
            'slug' => 'weatherbit'
        ]);

        Reading::create([
            'type' => 'AccuWeather',
            'endpoint' => '',
            'token' => '',
            'description' => 'Offers access to current weather data, forecasts, and severe weather alerts',
            'slug' => 'accuweather'
        ]);

        Reading::create([
            'type' => 'DarkSky',
            'endpoint' => '',
            'token' => '',
            'description' => 'Although it was acquired by Apple and discontinued its API service, you may still find some third-party implementations available',
            'slug' => 'darksky'
        ]);

        Reading::create([
            'type' => 'TheWeatherChannel',
            'endpoint' => '',
            'token' => '',
            'description' => 'Provides access to weather data from The Weather Channel',
            'slug' => 'theweatherchannel'
        ]);

        Reading::create([
            'type' => 'Climatempo',
            'endpoint' => '',
            'token' => '',
            'description' => 'Offers weather data for Brazil, including current conditions and forecasts',
            'slug' => 'climatempo'
        ]);

        Reading::create([
            'type' => 'OpenMeteo',
            'endpoint' => '',
            'token' => '',
            'description' => 'Provides weather data for Europe, including current conditions and forecasts',
            'slug' => 'openmeteo'
        ]);
    }
}
