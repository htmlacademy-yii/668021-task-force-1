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
        // Проверить, что заказчик не является исполнителем
        // Вернуть значение true, если все ок, иначе значение false
    }
}
