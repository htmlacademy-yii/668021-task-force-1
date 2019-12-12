<?php
namespace App\Models;

class Message
{
    public $id;
    public $message;
    public $sender_id;
    public $recipient_id;

    const NAME_TABLE = 'messages';
}
