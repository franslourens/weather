<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reading;
use App\Interfaces\Weather;


class Weatherbit extends Reading implements Weather
{
    protected $guarded = [];  

    public function getData () {
        $address = $this->attributes["address"];

        $response = Http::get($this->endpoint . "/daily", [
            'lat' => "51.5085",
            'lon' => "-0.1257",
            'key' => $this->token,
            'start_date' => date("Y-m-d"),
            'end_date' => date('Y-m-d', strtotime("+1 day"))
        ]);

        $data = json_decode($response->body(), true);
        return $data;
    }

    public function getContents() {
        $data = $this->getData();
        
        return ["temp" => $data["data"][0]["temp"],
                "min" => $data["data"][0]["min_temp"],
                "max" => $data["data"][0]["max_temp"]
               ];
    }

}