<?php
class Task {

    const STATUS_NEW = 'новое';
    const STATUS_PERFORMING = 'выполняется';
    const STATUS_CANCELED = 'отменено';
    const STATUS_FINISHED = 'завершено';
    const STATUS_FAILED = 'провалено';

    const ACTION_NEW = 'новое';
    const ACTION_FAIL = 'отказ';
    const ACTION_CANCEL = 'отмена';
    const ACTION_START = 'старт';
    const ACTION_FINISH = "завершить";

    const ROLE_EXECUTOR = 'исполнитель';
    const ROLE_COSTUMER = 'заказчик';



    private $id_executor;
    private $id_costumer;
    private $active_status;
    private $deadline;

    public function __construct()
    {
        // в конструкторе нужно определить заказчика, а также сменить статус задачи на новая
    }

    public function get_status()
    {

    }

    public function set_status()
    {

    }

}