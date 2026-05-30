<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;

class StudentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    public function view(User $user, Student $student): bool
    {
        return $user->isAdmin() || $user->isStaff() || $user->student?->id === $student->id;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    public function update(User $user, Student $student): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    public function delete(User $user, Student $student): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Student $student): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Student $student): bool
    {
        return $user->isAdmin();
    }
}
