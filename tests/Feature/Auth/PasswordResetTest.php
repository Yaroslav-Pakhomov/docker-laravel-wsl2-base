<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_reset_password_link_screen_can_be_rendered(): void
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    public function test_reset_password_link_can_be_requested(): void
    {
        // для показа более чёткой ошибки у тестов
        $this->withoutExceptionHandling();

        Notification::fake();

        $user = User::factory()->create();

        $this
            ->withSession(['_token' => 'bzz'])
            ->post('/forgot-password', [
                '_token' => 'bzz',
                'email'  => $user->email,
            ]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered(): void
    {
        // для показа более чёткой ошибки у тестов
        $this->withoutExceptionHandling();

        Notification::fake();

        $user = User::factory()->create();

        $this
            ->withSession(['_token' => 'bzz'])
            ->post('/forgot-password', [
                '_token' => 'bzz',
                'email'  => $user->email,
            ]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $response = $this
                ->get('/reset-password/' . $notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function test_password_can_be_reset_with_valid_token(): void
    {
        // для показа более чёткой ошибки у тестов
        $this->withoutExceptionHandling();

        Notification::fake();

        $user = User::factory()->create();

        $this
            ->withSession(['_token' => 'bzz'])
            ->post('/forgot-password', [
                '_token' => 'bzz',
                'email'  => $user->email,
            ]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $response = $this
                ->withSession(['_token' => 'bzz'])
                ->post('/reset-password', [
                    '_token'                => 'bzz',
                    'token'                 => $notification->token,
                    'email'                 => $user->email,
                    'password'              => 'password',
                    'password_confirmation' => 'password',
                ]);

            $response->assertSessionHasNoErrors();

            return true;
        });
    }
}
