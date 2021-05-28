<?php

namespace App\Repositories\Lesson;

use App\Lesson;

class LessonRepository implements LessonRepositoryInterface
{
    public function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    public function getLearnedLessonsByUserId($id)
    {
        $learned_lessons = $this->lesson->where('user_id', $id)->get();
        return $learned_lessons;
    }

}
