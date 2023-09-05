<?php

namespace Tests\Feature\Workers;

use App\Models\User;
use App\Models\Worker;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JsonException;
use Tests\TestCase;

class GeneralTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Редирект при входе
     *
     * @return void
     */
    public function test_dashboard(): void
    {
        // для показа более чёткой ошибки у тестов
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this
            ->withSession(['_token' => 'bzz'])
            ->post(route('login'), [
                '_token'   => 'bzz',
                'email'    => $user->email,
                'password' => 'password',
            ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * Работники
     *
     * @return void
     */
    public function test_get_workers(): void
    {
        // ->get() - возвращает коллекцию, а ->first() - модель
        $user = User::query()->where('id', 1)->first();

        if ($user instanceof Authenticatable) {
            $response = $this->actingAs($user)
                ->get(route('workers.index'));

            $response->assertStatus(200);
        }

    }

    /**
     * Работник
     *
     * @return void
     */
    public function test_get_worker(): void
    {
        // ->get() - возвращает коллекцию, а ->first() - модель
        $user = User::query()->where('id', 1)->first();

        if ($user instanceof Authenticatable) {
            $response = $this->actingAs($user)
                ->get(route('workers.show', 1));

            $response->assertStatus(200);
        }

    }

    /**
     * Страница создания Работника
     *
     * @return void
     */
    public function test_get_create_worker(): void
    {
        // ->get() - возвращает коллекцию, а ->first() - модель
        $user = User::query()->where('id', 1)->first();

        if ($user instanceof Authenticatable) {
            $response = $this->actingAs($user)
                ->get(route('workers.create'));

            $response->assertStatus(200);
        }

    }

    /**
     * Страница редактирования Работника
     *
     * @return void
     */
    public function test_get_edit_worker(): void
    {
        // ->get() - возвращает коллекцию, а ->first() - модель
        $user = User::query()->where('id', 1)->first();

        if ($user instanceof Authenticatable) {
            $response = $this->actingAs($user)
                ->get(route('workers.edit', 1));

            $response->assertStatus(200);
        }

    }

    /**
     * Отправка формы создания Работника
     *
     * @return void
     */
    public function test_post_store_worker(): void
    {
        // для показа более чёткой ошибки у тестов
        // $this->withoutExceptionHandling();

        // ->get() - возвращает коллекцию, а ->first() - модель
        $user = User::query()->where('id', 1)->first();

        if ($user instanceof Authenticatable) {
            $worker = Worker::factory()->create();

            $response = $this
                ->withSession(['_token' => 'bzz'])
                ->actingAs($user)
                ->post(route('workers.store'), [
                    '_token' => 'bzz',

                    'name'        => $worker->name,
                    'surname'     => $worker->surname,
                    'email'       => $worker->email,
                    'age'         => $worker->age,
                    'description' => $worker->description,
                    'is_married'  => $worker->is_married,
                ]);

            $response->assertStatus(302);
        }

    }

    /**
     * Отправка формы редактирования Работника
     *
     * @return void
     *
     * @throws JsonException
     */
    public function test_patch_update_worker(): void
    {
        // для показа более чёткой ошибки у тестов
        $this->withoutExceptionHandling();

        // ->get() - возвращает коллекцию, а ->first() - модель
        $user = User::query()->where('id', 1)->first();

        if ($user instanceof Authenticatable) {
            $worker = Worker::factory()->create();

            $response = $this
                ->withSession(['_token' => 'bzz'])
                ->actingAs($user)
                ->patch(route('workers.update', $worker), [
                    '_token' => 'bzz',

                    'name'        => $worker->name,
                    'surname'     => $worker->surname,
                    'email'       => $worker->email,
                    'age'         => $worker->age,
                    'description' => $worker->description,
                    'is_married'  => $worker->is_married ? 'on' : '',
                ]);

            $response
                ->assertSessionHasNoErrors()
                ->assertRedirect(route('workers.show', $worker));
        }
    }


    /**
     * Отправка формы удаления Работника
     *
     * @return void
     *
     * @throws JsonException
     */
    public function test_delete_delete_worker(): void
    {
        // для показа более чёткой ошибки у тестов
        $this->withoutExceptionHandling();

        // ->get() - возвращает коллекцию, а ->first() - модель
        $user = User::query()->where('id', 1)->first();

        if ($user instanceof Authenticatable) {
            $worker = Worker::factory()->create();

            $response = $this
                ->withSession(['_token' => 'bzz'])
                ->actingAs($user)
                ->delete(route('workers.delete', $worker), [
                    '_token' => 'bzz',
                ]);

            $response
                ->assertSessionHasNoErrors()
                ->assertRedirect(route('workers.index'));
        }
    }
}
