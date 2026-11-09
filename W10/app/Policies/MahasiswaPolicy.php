<?php

namespace App\Policies;

use App\Models\Mahasiswa;
use App\Models\User;

class MahasiswaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('manage-mahasiswa');
    }

    public function view(User $user, Mahasiswa $mahasiswa): bool
    {
        return $user->can('manage-mahasiswa');
    }

    public function create(User $user): bool
    {
        return $user->can('manage-mahasiswa');
    }

    public function update(User $user, Mahasiswa $mahasiswa): bool
    {
        return $user->can('manage-mahasiswa');
    }

    public function delete(User $user, Mahasiswa $mahasiswa): bool
    {
        return $user->hasRole('Admin') && $user->can('hapus-data');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasRole('Admin') && $user->can('hapus-data');
    }
}
