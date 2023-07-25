<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model 
{ 
    use HasFactory;

    protected $table = 'reading';
    public $address;

    public function cast() {
        $data = $this->toArray();

        $cast = "\\App\\Models\\" . $this->type;

        if (!class_exists($cast)) {
            throw new \Exception("API not implemented yet, please contact an administrator");
        }

        $model = new $cast();

        $model->fill($data);
        
        return $model;
    }

    public static function collection($location = null, $type = null) {
        $readings = Reading::all();

        $response = [];

        foreach($readings as $reading) {
           try {            
              $reading->attributes["address"] = $location; 
              $model = $reading->cast();
              $response[$reading->type] = $model->data();
           } catch(\Exception $e) {
                $response[$reading->type] = $e->getMessage();
           }
        }

        return $response;
    }
}
