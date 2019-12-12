<?php
namespace App\Models;

class ResponsesTask
{
    public $id;
    public $commentary;
    public $initiator_price;
    public $user_id;
    public $task_id;

    const NAME_TABLE = 'responses_task';
}
