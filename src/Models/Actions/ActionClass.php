<?php
namespace App\Models\Actions;
use App\Models\Task;

abstract class ActionClass
{
    abstract public static function getName();
    abstract public static function checkRules(Task $task, int $initiator_id);
    abstract public static function getInnerName();
}
