<?php

namespace App\Policies;

use App\Models\Mark;
use App\Models\User;

class MarkPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    public function view(User $user, Mark $mark): bool
    {
        return $user->isAdmin() || $user->isStaff() || $user->student?->id === $mark->student_id;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    public function update(User $user, Mark $mark): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    public function delete(User $user, Mark $mark): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Mark $mark): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Mark $mark): bool
    {
        return $user->isAdmin();
    }
}
