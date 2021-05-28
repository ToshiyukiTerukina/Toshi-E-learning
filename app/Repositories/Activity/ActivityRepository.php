<?php

namespace App\Repositories\Activity;

use App\Activity;

class ActivityRepository implements ActivityRepositoryInterface
{
    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function getAllActivity()
    {
        $activities = $this->activity->orderBy('created_at', 'desc')->get();
        return $activities;
    }

}
