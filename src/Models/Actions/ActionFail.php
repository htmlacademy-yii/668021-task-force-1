<?php
namespace App\Models\Actions;
use App\Models\Task;

class ActionFail extends ActionClass
{
    public static function getName(): string
    {
        return self::class;
    }

    public static function getInnerName(): string
    {
        return 'Fail';
    }

    public static function checkRules(Task $task, int $initiator_id): bool
    {
        if (($task->getStatus() !== Task::STATUS_PROCESSING))
        {
            return false;
        }

        if ($initiator_id === $task->getCustomer())
        {
            return false;
        }

        if ($initiator_id !== $task->getExecutor())
        {
            return false;
        }

        return true;
    }
}
