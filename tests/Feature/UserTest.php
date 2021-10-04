<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_users()
    {
        $user = $this->signIn();

        $userToken = $user->createToken('auth');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$userToken->plainTextToken,
        ])->get('/api/users');

        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                "success",
                "status",
                "message",
                "data",
            ]
        );

        $this->assertTrue($response->json("success"));
    }
}
