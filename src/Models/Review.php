<?php
namespace App\Models;

class Review
{
    public $id;
    public $creation_time;
    public $commentary;
    public $evaluation;
    public $task_id;

    const NAME_TABLE = 'reviews';
}
