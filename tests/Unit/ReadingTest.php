<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Reading;

class ReadingTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

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
}
