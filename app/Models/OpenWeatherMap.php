<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reading;
use App\Interfaces\Weather;


class OpenWeatherMap extends Reading implements Weather
{
    protected $guarded = [];  

    public function getData () {
        $geolocation = $this->getGeocode($this->attributes["address"]);
        
        $address = $geolocation["address"];

        $response = Http::get($this->endpoint, [
            'q' => $address,
            'units' => 'metric',
            'appid' => $this->token
        ]);

        $data = json_decode($response->body(), true);
        return $data;
    }

    public function getContents() {
        $data = $this->getData();

        return ["temp" => $data["main"]["temp"],
                "min" => $data["main"]["temp_min"],
                "max" => $data["main"]["temp_max"]
               ];
    }

}