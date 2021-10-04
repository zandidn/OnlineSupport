<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    use CreatesApplication;

    public function signIn(User $user = null)
    {
        if (!$user) {
            if (!User::query()->where('email', 'john@doe.com')->exists()) {
                $user = User::factory()->create([
                    'name'        => 'John Doe',
                    'email'       => 'john@doe.com',
                    'is_supporter' => 1
                ]);
            } else {
                $user = User::query()->where('email', 'john@doe.com')->first();
            }
        }
        $this->be($user);

        return $user;
    }
}
