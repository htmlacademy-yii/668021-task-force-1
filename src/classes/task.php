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
    const ROLE_CUSTOMER = 'заказчик';



    private $executor_id;
    private $customer_id;
    private $status;
    private $deadline;

    public function __construct()
    {
        // в конструкторе нужно определить заказчика, а также сменить статус  задачи на новая
    }

    public function getNextStatus ($action)
    {
        switch ($action) {
            case self::ACTION_NEW:
                $this->status = self::STATUS_NEW;
                break;
            case self::ACTION_FAIL:
                $this->status = self::STATUS_FAILED;
                break;
            case self::ACTION_CANCEL:
                $this->status = self::STATUS_CANCELED;
                break;
            case self::ACTION_START:
                $this->status = self::STATUS_PERFORMING;
                break;
            case self::ACTION_FINISH:
                $this->status = self::STATUS_FINISHED;
                break;
            default:
                $this->status = null;
        }

        return $this->status;
    }

    public function get_status()
    {

    }

    public function set_status()
    {

    }

}


$task = new Task();

$nextStatus = $task->getNextStatus(Task::ACTION_FINISH);
echo $nextStatus;

