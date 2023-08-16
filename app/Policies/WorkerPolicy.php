<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Auth\Access\Response;

class WorkerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): void
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Worker $worker): void
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     *
     * @return Response
     */
    public function create(User $user): Response
    {
        return (int)$user->role === User::ROLE_ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403, 'Недостаточно прав.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Worker $worker
     *
     * @return Response
     */
    public function update(User $user, Worker $worker): Response
    {
        // $worker нужен на случай сравнения ID создателя (напр. $worker->user_id) с ID пользователя $user->id, если это требуется
        return (int)$user->role === User::ROLE_ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403, 'Недостаточно прав.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Worker $worker
     *
     * @return Response
     */
    public function delete(User $user, Worker $worker): Response
    {
        // $worker нужен на случай сравнения ID создателя (напр. $worker->user_id) с ID пользователя $user->id, если это требуется
        return (int)$user->role === User::ROLE_ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403, 'Недостаточно прав.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Worker $worker): void
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Worker $worker): void
    {
        //
    }
}
