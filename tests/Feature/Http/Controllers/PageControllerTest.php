<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\Repository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_return_200()
    {
        $this->withExceptionHandling();

        $repository = Repository::factory()->create();

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee($repository->url);
    }
}
