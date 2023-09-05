<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JsonException;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/confirm-password');

        $response->assertStatus(200);
    }

    /**
     * @throws JsonException
     */
    public function test_password_can_be_confirmed(): void
    {
        // для показа более чёткой ошибки у тестов
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this
            ->withSession(['_token' => 'bzz'])
            ->actingAs($user)
            ->post('/confirm-password', [
                '_token'   => 'bzz',
                'password' => 'password',
            ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        // // для показа более чёткой ошибки у тестов
        // $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this
            ->withSession(['_token' => 'bzz'])
            ->actingAs($user)
            ->post('/confirm-password', [
                '_token'   => 'bzz',
                'password' => 'wrong-password',
            ]);

        $response->assertSessionHasErrors();
    }
}
