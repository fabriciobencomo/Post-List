<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Repository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_repository_belong_to_user()
    {
        $repository = Repository::factory()->create();

        $this->assertInstanceOf(User::class, $repository->user);
    }
}
