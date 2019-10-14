<?php

namespace htmlacademy\BusinessLogic;
use Exception;

class Task {

    const STATUS_NEW = 'новое';
    const STATUS_PROCESSING = 'выполняется';
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

    public function __construct(int $customer_id)
    {
        $this->status = self::STATUS_NEW;
        $this->customer_id = $customer_id;
        // в конструкторе нужно определить заказчика, а также сменить статус  задачи на новая
    }

    public function getNextStatus (string $action)
    {
        switch ($action) {
            case self::ACTION_NEW:
                return self::STATUS_NEW;

            case self::ACTION_FAIL:
                return self::STATUS_FAILED;
                break;
            case self::ACTION_CANCEL:
                return self::STATUS_CANCELED;
                break;
            case self::ACTION_START:
                return self::STATUS_PROCESSING;
                break;
            case self::ACTION_FINISH:
                return self::STATUS_FINISHED;
                break;
            default:
                return null;
        }

    }

    public function cancel (int $initiator_id) {

        if ($initiator_id !== $this->customer_id) {
            throw new Exception('Отменяющий задачу не является заказчиком');
        }
        if ($this->status !== self::STATUS_NEW) {
            throw new Exception('Отменить задачу можно тогда, когда имеет статус новая');
        }
        $this->status = self::STATUS_CANCELED;
    }

    public function start (int $initiator_id) {

        if ($initiator_id === $this->customer_id) {
            throw new Exception('Взять на выполнение задачу может только исполнитель, а не заказчик');
        }
        $this->status = self::STATUS_PROCESSING;
    }

    public function fail (int $initiator_id) {
        if ($initiator_id === $this->customer_id) {
            throw new Exception('Отказ от задачи доступен только исполнителю');
        }
        $this->status = self::STATUS_FAILED;
    }

    public function finish (int $initiator_id) {
        if ($initiator_id !== $this->customer_id) {
            throw new Exception('Завершить и принять задачу может только сам заказчик');
        }
        $this->status = self::STATUS_FINISHED;
    }
}




