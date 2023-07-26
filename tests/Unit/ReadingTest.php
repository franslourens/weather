<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Reading;

class ReadingTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test the user database.
     *
     * @return void
     */
     public function test_user_database()
     {
        Reading::factory()->count(3)->create();
     
        $this->assertDatabaseCount('reading', 3);
     }

    public function castProvider() : array
    { 
        return array(
            array("OpenWeatherMap", array('type' => "OpenWeatherMap", "endpoint" => "", "token" => "", "description" => "", "slug" => "openweathermap"), "App\Models\OpenWeatherMap"),
            array("Weatherbit", array('type' => "Weatherbit", "endpoint" => "", "token" => "", "description" => "", "slug" => "weatherbit"), "App\Models\Weatherbit")
        );
    }

    /**
     * @dataProvider castProvider
     * @test
     */
    public function cast($type, $data, $result) {
        
        $reading = new Reading();
        $reading->fill($data);
        
        $model = $reading->cast();

        $this->assertEquals(get_class($model), $result);
    }

    public function castFailProvider() : array
    { 
        return array(
            array("Weather", array('type' => "weather", "endpoint" => "", "token" => "", "description" => "", "slug" => "weather"), "Exception", "API not implemented yet, please contact an administrator"),
        );
    }

    /**
     * @dataProvider castFailProvider
     * @test
     */
    public function castFail($type, $data, $expectedException, $message) {
        $reading = new Reading();
        $reading->fill($data);

        $this->expectException($expectedException);
        $this->expectExceptionMessage($message);
        $model = $reading->cast();
    }
}
