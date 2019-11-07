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
        // 1. Проверяем статус задачи "В работе", если нет, возвращаем false
        // 2. Проверяем роль пользователя, является ли он заказчиком, если нет, то возвращаем false
        // 3. В остальных случаях возвращаем true
        if (($task->getStatus() === Task::STATUS_PROCESSING) && ($initiator_id === $task->getCustomer())) {
            return true;
        }
        return false;
    }
}
