<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JsonReportFormatter;

class Reading extends Model 
{ 
    use HasFactory;

    protected $table = 'reading';

    public $address;


    public function __construct($location = null)
    {
        if($location) {
            $this->attributes["address"] = $location; 
        }
    }

    /*
     * Cast
     *
     * This method will take the Reading model and based on its type
     * cast the object so that the approriate methods can be called to get the data from how the different api's require the parameters to be set
     * 
     * @param string $location
     * 
     * @return object
     */
    public function cast($location) {
        $data = $this->toArray();

        $cast = "\\App\\Models\\" . $this->type;

        if (!class_exists($cast)) {
            throw new \Exception("API not implemented yet, please contact an administrator");
        }

        $model = new $cast($location);

        $model->fill($data);
        
        return $model;
    }

    /*
     * Collection
     *
     * Lists all the weather forcasts based on the apis that have been implemented so far, otherwise a proper message will be displayed if not implemented yet
     * 
     * @param string $location
     * @param string $type
     *
     * @return array
     */
    public static function collection($location = null, $type = null) {
        $readings = Reading::all();

        $response = [];

        $formatter = new JsonReportFormatter();

        foreach($readings as $reading) {
           try {            
              $response[$reading->type] = $formatter->format($reading->cast($location));
           } catch(\Exception $e) {
                $response[$reading->type] = $e->getMessage();
           }
        }

        return $response;
    }
}
