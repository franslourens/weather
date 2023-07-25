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

    public function get () {
        $address = $this->attributes["address"];

        $response = Http::get($this->endpoint, [
            'q' => $address,
            'appid' => $this->token
        ]);

        $data = json_decode($response->body(), true);
        return $data;
    }

    public function data() {
        return $this->get();
    }

}