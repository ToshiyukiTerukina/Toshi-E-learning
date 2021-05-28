<?php

namespace App\Repositories\Lesson;


interface LessonRepositoryInterface
{

    public function getLearnedLessonsByUserId($id);
}
