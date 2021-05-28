<?php

namespace App\Repositories\Word;


interface WordRepositoryInterface
{

    public function getLearnedWordsByUserId($id);

}
