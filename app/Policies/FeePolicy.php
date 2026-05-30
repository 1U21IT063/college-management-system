<?php

namespace App\Policies;

use App\Models\Fee;
use App\Models\User;

class FeePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    public function view(User $user, Fee $fee): bool
    {
        return $user->isAdmin() || $user->isStaff() || $user->student?->id === $fee->student_id;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    public function update(User $user, Fee $fee): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    public function delete(User $user, Fee $fee): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Fee $fee): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Fee $fee): bool
    {
        return $user->isAdmin();
    }
}
