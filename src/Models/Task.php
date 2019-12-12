<?php

namespace App\Models;
use App\Exception\StatusException;
use App\Models\Actions\ActionCancel;
use App\Models\Actions\ActionFail;
use App\Models\Actions\ActionFinish;
use App\Models\Actions\ActionNew;
use App\Models\Actions\ActionStart;
use Exception;

class Task {

    public $id;
    public $name;
    public $description;
    public $category_id;
    public $files;
    public $price;
    public $deadline;
    public $creation_time;
    public $initiator_id;
    public $customer_id;
    public $location_id;
    public $status_id;

    const NAME_TABLE = 'tasks';

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
    private $status;
    private $listAccessActions=[];

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getCustomer(): ?int
    {
        return $this->customer_id;
    }

    public function getExecutor(): ?int
    {
        return $this->executor_id;
    }

    public function __construct(int $customer_id)
    {
        $this->status = self::STATUS_NEW;
        $this->customer_id = $customer_id;
        // в конструкторе нужно определить заказчика, а также сменить статус  задачи на новая
    }

    public function getNextStatus (string $action): ?string
    {
        switch ($action) {
            case ActionNew::getName():
                return self::STATUS_NEW;
            case ActionFail::getName():
                return self::STATUS_FAILED;
            case ActionCancel::getName():
                return self::STATUS_CANCELED;
            case ActionStart::getName():
                return self::STATUS_PROCESSING;
            case ActionFinish::getName():
                return self::STATUS_FINISHED;
            default:
                return null;
        }

    }

    public function cancel(int $initiator_id): void
    {

        if ($initiator_id !== $this->customer_id) {
            throw new Exception('Отменяющий задачу не является заказчиком');
        }
        if ($this->status !== self::STATUS_NEW) {
            throw new Exception('Отменить задачу можно тогда, когда имеет статус новая');
        }
        $this->status = self::STATUS_CANCELED;
    }

    public function start(int $initiator_id): void
    {

        if ($initiator_id === $this->customer_id) {
            throw new Exception('Взять на выполнение задачу может только исполнитель, а не заказчик');
        }
        $this->status = self::STATUS_PROCESSING;
    }

    public function fail(int $initiator_id): void
    {
        if ($initiator_id === $this->customer_id) {
            throw new Exception('Отказ от задачи доступен только исполнителю');
        }
        if ($this->status === self::STATUS_PROCESSING) {
            $this->status = self::STATUS_FAILED;
        } else {
            throw new Exception('Выполнить отказ от задачи можно только при условии, что задача в статусе выполнения');
        }
    }

    public function finish(int $initiator_id): void
    {
        if ($initiator_id !== $this->customer_id) {
            throw new Exception('Завершить и принять задачу может только сам заказчик');
        }
        if ($this->status === self::STATUS_PROCESSING) {
            $this->status = self::STATUS_FINISHED;
        } else {
            throw new Exception('Завершить задачу можно, если она находится в статусе выполнения');
        }
    }

    public function accessActions(string $status, int $initiator_id): array
    {
        // Проверка переменной статуса на существование(статус может быть только из списка констант, любое другое значение
        // вызывает исключение
        if (!$this->checkStatus($status)) {
            throw new StatusException();
        }

        $this->status = $status;

        $this->listAccessActions = [
            ActionNew::getName() => ActionNew::checkRules($this, $initiator_id),
            ActionCancel::getName() => ActionCancel::checkRules($this, $initiator_id),
            ActionStart::getName() => ActionStart::checkRules($this, $initiator_id),
            ActionFail::getName() => ActionFail::checkRules($this, $initiator_id),
            ActionFinish::getName() => ActionFinish::checkRules($this, $initiator_id)
        ];
        return $this->listAccessActions;
    }

    private function checkStatus(string $status): bool
    {
        $reflectionClass = new \ReflectionClass($this);
        $listConstants = $reflectionClass->getConstants();
        foreach ($listConstants as $constant) {
            if ($status === $constant) {
                return true;
            }
        }
        return false;
    }
}




