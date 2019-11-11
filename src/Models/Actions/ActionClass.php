<?php
namespace App\Models\Actions;
use App\Models\Task;

abstract class ActionClass
{
    abstract public static function getName(): string;
    abstract public static function getInnerName(): string;
    abstract public static function checkRules(Task $task, int $initiator_id): bool;
}
