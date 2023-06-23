<?php

namespace App\Policies;

use App\Models\ScheduleClass;
use App\Models\User;

class ScheduleClassPolicy
{
    public function delete(User $user, ScheduleClass $scheduleClass)
    {
        return $user->id === $scheduleClass->instructor_id;
    }
}
