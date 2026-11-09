<?php

namespace App\Policies;

use App\Models\Tugas;
use App\Models\User;

class TugasPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('manage-tugas');
    }

    public function view(User $user, Tugas $tugas): bool
    {
        return $user->can('manage-tugas');
    }

    public function create(User $user): bool
    {
        return $user->can('manage-tugas');
    }

    public function update(User $user, Tugas $tugas): bool
    {
        return $user->can('manage-tugas');
    }

    public function delete(User $user, Tugas $tugas): bool
    {
        return $user->hasRole('Admin') && $user->can('hapus-data');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasRole('Admin') && $user->can('hapus-data');
    }
}
