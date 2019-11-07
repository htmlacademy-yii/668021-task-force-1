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
        // TODO: Implement checkRules() method.
        // 1. Проверяем статус задачи "Новая", если нет, возвращаем false
        // 2. Проверяем роль пользователя, является ли он исполнителем, если да, то возвращаем false
        // 3. В остальных случаях возвращаем true
        if (($task->getStatus() === Task::STATUS_NEW) && ($initiator_id === $task->getCustomer())) {
            return true;
        }
        return false;
    }
}
