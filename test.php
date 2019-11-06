<?php

use App\Models\Actions;
use App\Models\Task;


require_once 'vendor/autoload.php';

$customer_id = 5;

$task = new Task($customer_id);

$initiator_id = $customer_id;
$task->cancel($initiator_id);

try {
    $initiator_id = 6;
    $task->cancel($initiator_id);
} catch (Exception $exception) {
    echo $exception->getMessage();
}

try {
    $initiator_id = 5;
    $task->start($initiator_id);
} catch (Exception $exception) {
    echo $exception->getFile();
}

try {
    $initiator_id = 5;
    $task->fail($initiator_id);
} catch (Exception $exception) {
    echo $exception->getLine();
}

try {
    $initiator_id = 6;
    $task->finish($initiator_id);
} catch (Exception $exception) {
    echo $exception->getCode();
}

$nextStatus = $task->getNextStatus(Actions\ActionNew::class);
assert($nextStatus === Task::STATUS_NEW, 'При создании задачи возвращается корректный статус');

$nextStatus = $task->getNextStatus(Actions\ActionFail::class);
assert($nextStatus === Task::STATUS_FAILED, 'При отказе от задачи возвращается корректный статус');

$nextStatus = $task->getNextStatus(Actions\ActionCancel::class);
assert($nextStatus === Task::STATUS_CANCELED, 'При отмене задачи возвращается корректный статус');

$nextStatus = $task->getNextStatus(Actions\ActionStart::class);
assert($nextStatus === Task::STATUS_PROCESSING, 'При старте задачи возвращается корректный статус');

$nextStatus = $task->getNextStatus(Actions\ActionFinish::class);
assert($nextStatus === Task::STATUS_FINISHED, 'При завершении задачи возвращается корректный статус');


