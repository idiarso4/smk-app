<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_users');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_users');
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasPermissionTo('edit_users');
    }

    public function delete(User $user, User $model): bool
    {
        // Super Admin tidak bisa dihapus
        if ($model->hasRole('Super Admin')) {
            return false;
        }
        return $user->hasPermissionTo('delete_users');
    }
} 