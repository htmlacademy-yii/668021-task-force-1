<?php
namespace App\Models\Actions;
use App\Models\Task;

class ActionStart extends ActionClass
{
    public static function getName()
    {
        return self::class;
    }

    public static function getInnerName()
    {
        return 'Start';
    }

    public static function checkRules(Task $task, int $initiator_id)
    {
        if ($task->getStatus() !== Task::STATUS_NEW) return false;
        if ($initiator_id === $task->getCustomer()) return false;

        return true;
    }
}
