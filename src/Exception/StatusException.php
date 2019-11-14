<?php
namespace App\Exception;
use Exception;

class StatusException extends Exception
{
    public function __construct($message = "Такого статуса не существует")
    {
        parent::__construct($message);
    }
}
