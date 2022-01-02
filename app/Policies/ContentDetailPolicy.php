<?php

namespace App\Policies;

use App\Models\ContentDetail;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentDetailPolicy
{
    use HandlesAuthorization;

    //Función que verifica si el usuario posee el rol SUPERADMIN y le concede todos los permisos
    public function before(User $user, $ability)
    {
        if ($user->isGranted(User::ROLE_SUPERADMIN)) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //Puede realizar esta accion si posee el rol de USER
        return $user->isGranted(User::ROLE_USER);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContentDetail  $contentDetail
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContentDetail $contentDetail)
    {
        //Puede realizar esta accion si posee el rol de USER y los id de las tablas coinciden
        return $user->isGranted(User::ROLE_USER) && $user->id === $contentDetail->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //Puede realizar esta accion si posee el rol de USER
        return $user->isGranted(User::ROLE_USER);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContentDetail  $contentDetail
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContentDetail $contentDetail)
    {
        //Puede realizar esta accion si posee el rol de USER y los id de las tablas coinciden
        return $user->isGranted(User::ROLE_USER) && $user->id === $contentDetail->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContentDetail  $contentDetail
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContentDetail $contentDetail)
    {
        //Puede realizar esta accion si posee el rol de SUPERADMIN
        return $user->isGranted(User::ROLE_SUPERADMIN);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContentDetail  $contentDetail
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ContentDetail $contentDetail)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContentDetail  $contentDetail
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ContentDetail $contentDetail)
    {
        //
    }
}
