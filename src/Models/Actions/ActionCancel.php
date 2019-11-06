<?php
namespace App\Models\Actions;
use App\Models\Task;

class ActionCancel extends ActionClass
{
    public static function getName()
    {
        return self::class;
    }

    public static function getInnerName()
    {
        return 'Cancel';
    }

    public static function checkRules(Task $task, int $initiator_id)
    {

    }
}
