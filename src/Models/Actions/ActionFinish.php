<?php
namespace App\Models\Actions;
use App\Models\Task;

class ActionFinish extends ActionClass
{
    public static function getName()
    {
        return self::class;
    }

    public static function getInnerName()
    {
        return 'Finish';
    }

    public static function checkRules(Task $task, int $initiator_id)
    {
        // TODO: Implement checkRules() method.
    }
}
