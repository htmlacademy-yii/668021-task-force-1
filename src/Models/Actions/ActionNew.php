<?php
namespace App\Models\Actions;
use App\Models\Task;

class ActionNew extends ActionClass
{
    public static function getName(): string
    {
        return self::class;
    }

    public static function getInnerName(): string
    {
        return 'New';
    }

    public static function checkRules(Task $task, int $initiator_id): bool
    {
        if (($task->getStatus() !== null))
        {
            return false;
        }

        if ($initiator_id === $task->getExecutor())
        {
            return false;
        }

        return true;
    }
}
