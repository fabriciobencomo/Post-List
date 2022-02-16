<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RepositoryControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guest()
    {
        $this->get('repositories')->assertRedirect('login');    //index
        $this->get('repositories/create')->assertRedirect('login');     // create
        $this->post('repositories')->assertRedirect('login');   // store
        $this->get('repositories/1')->assertRedirect('login');  // show
        $this->get('repositories/1/edit')->assertRedirect('login');     // edit
        $this->put('repositories/1')->assertRedirect('login');  // update
        $this->delete('repositories/1')->assertRedirect('login');   // destroy
    }

    public function test_store_repository()
    {
        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text
        ];

        $user = User::factory()->create();

        $this->actingAs($user)->post('repositories', $data)->assertRedirect('repositories');

        $this->assertDatabaseHas('repositories', $data);

    }
}
