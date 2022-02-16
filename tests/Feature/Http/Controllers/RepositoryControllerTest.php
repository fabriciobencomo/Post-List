<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Repository;
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

    //index

    public function test_index_empty()
    {
        Repository::factory()->create();

        $user = User::factory()->create();

        $this->actingAs($user)->get('repositories')
            ->assertStatus(200)
            ->assertSee('No Repositories Yet ...');
    }

    public function test_index_with_data()
    {
        $user = User::factory()->create();

        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)->get('repositories')->assertStatus(200)->assertSee($repository->id)->assertSee($repository->url);
    }

    /*
        * Create
    */


    public function test_create_repository()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get("repositories/create")->assertStatus(200);

    }

    /*
        * Store
    */

    public function test_store_repository()
    {
        $user = User::factory()->create();

        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text
        ];

        $this->actingAs($user)->post('repositories', $data)->assertRedirect('repositories');

        $this->assertDatabaseHas('repositories', $data);

    }

    public function test_validate_store_repository()
    {

        $user = User::factory()->create();

        $this->actingAs($user)->post('repositories', [])->assertStatus(302)->assertSessionHasErrors(['url', 'description']);
    }

    /*
        * Show
    */


    public function test_show_repository()
    {
        $user = User::factory()->create();

        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)->get("repositories/{$repository->id}")->assertStatus(200)->assertSee($repository->description)->assertSee($repository->url);

    }

    public function test_show_policy_repository()
    {
        $user = User::factory()->create();

        $repository = Repository::factory()->create();

        $this->actingAs($user)->get("repositories/{$repository->id}")->assertStatus(403);

    }

    /*
        * Edit
    */

    public function test_edit_repository()
    {
        $user = User::factory()->create();

        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)->get("repositories/{$repository->id}/edit")->assertStatus(200)->assertSee($repository->description)->assertSee($repository->url);

    }

    public function test_edit_policy_repository()
    {
        $user = User::factory()->create();

        $repository = Repository::factory()->create();

        $this->actingAs($user)->get("repositories/{$repository->id}/edit")->assertStatus(403);

    }

    /*
        * Update
    */

    public function test_update_repository()
    {
        $user = User::factory()->create();

        $repository = Repository::factory()->create(['user_id'=> $user->id]);

        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text
        ];

        $this->actingAs($user)->put("repositories/{$repository->id}", $data)->assertRedirect('repositories');

        $this->assertDatabaseHas('repositories', $data);

    }

    public function test_validate_update_repository()
    {
        $repository = Repository::factory()->create();

        $user = User::factory()->create();

        $this->actingAs($user)->put("repositories/{$repository->id}", [])->assertStatus(302)->assertSessionHasErrors(['url', 'description']);
    }


    public function test_update_policy_repository()
    {
        $user = User::factory()->create();

        $repository = Repository::factory()->create();

        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text
        ];

        $this->actingAs($user)->put("repositories/{$repository->id}", $data)->assertStatus(403);

    }

    /*
        * Destroy
    */


    public function test_destroy_repository()
    {
        $user = User::factory()->create();

        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)->delete("repositories/{$repository->id}")->assertRedirect('repositories');

        $this->assertDatabaseMissing('repositories', [
            'id' => $repository->id
        ]);


    }

    public function test_destroy_policy_repository()
    {
        $repository = Repository::factory()->create();

        $user = User::factory()->create();

        $this->actingAs($user)->delete("repositories/{$repository->id}")->assertStatus(403);

    }


}
