<?php
namespace App\Models;

class NotificationsUser
{
    public $id;
    public $user_id;
    public $responses;
    public $messages;
    public $task_action;

    const NAME_TABLE = 'notifications_users';
}
