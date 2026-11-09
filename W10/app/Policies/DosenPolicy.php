<?php

namespace App\Policies;

use App\Models\Dosen;
use App\Models\User;

class DosenPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('manage-dosen');
    }

    public function view(User $user, Dosen $dosen): bool
    {
        return $user->can('manage-dosen');
    }

    public function create(User $user): bool
    {
        return $user->can('manage-dosen');
    }

    public function update(User $user, Dosen $dosen): bool
    {
        return $user->can('manage-dosen');
    }

    public function delete(User $user, Dosen $dosen): bool
    {
        return $user->hasRole('Admin') && $user->can('hapus-data');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasRole('Admin') && $user->can('hapus-data');
    }
}
