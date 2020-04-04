<?php

namespace App\Policies;

use App\User;
use App\CronJob;
use Illuminate\Support\Facades\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CronjobPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\CronJob  $cronJob
     * @return mixed
     */
    public function view(User $user, CronJob $cronJob)
    {
        return $user->id === $cronJob->user_id  ? Response::allow() : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\CronJob  $cronJob
     * @return mixed
     */
    public function update(User $user, CronJob $cronJob)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\CronJob  $cronJob
     * @return mixed
     */
    public function delete(User $user, CronJob $cronJob)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\CronJob  $cronJob
     * @return mixed
     */
    public function restore(User $user, CronJob $cronJob)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\CronJob  $cronJob
     * @return mixed
     */
    public function forceDelete(User $user, CronJob $cronJob)
    {
        //
    }
}
