<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function app;

class UserRepositoryTest extends TestCase
{
    use WithFaker;

    /**
     * A basic user repository test
     *
     * @group test-user-repo
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function test_user_create_update()
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', ['name' => $user->name, 'email' => $user->email]);

        $newName = $this->faker->unique()->name();
        $newEmail = $this->faker->unique()->safeEmail();

        $this->getUserRepositoryInstance()->update([
            'name'  => $newName,
            'email' => $newEmail,
        ], $user->id);

        $this->assertDatabaseHas('users', ['name' => $newName, 'email' => $newEmail]);
    }

    /**
     * @return \App\Repositories\UserRepository
     */
    public function getUserRepositoryInstance() : UserRepository
    {
        return app()->get(UserRepository::class);
    }
}
