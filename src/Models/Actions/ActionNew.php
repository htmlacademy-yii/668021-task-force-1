<?php
namespace App\Models\Actions;
use App\Models\Task;

class ActionNew extends ActionClass
{
    public static function getName()
    {
        return self::class;
    }

    public static function getInnerName()
    {
        return 'New';
    }

    public static function checkRules(Task $task, int $initiator_id)
    {
        // TODO: Implement checkRules() method.
        // 1. Проверить, что пользователь не является исполнителем
        // 2. Проверить, что у задачи нету статуса;
        // 2. Вернуть значение true, если все ок, иначе значение false
        if (($task->getStatus() === null) && ($initiator_id !== $task->getExecutor())) {
            return true;
        }
        return false;
    }
}
