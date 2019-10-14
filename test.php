<?php
require_once __DIR__ . '/src/classes/Task.php';

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

$nextStatus = $task->getNextStatus(Task::ACTION_NEW);
assert($nextStatus === Task::STATUS_NEW, 'При создании задачи возвращается корректный статус');

$nextStatus = $task->getNextStatus(Task::ACTION_FAIL);
assert($nextStatus === Task::STATUS_FAILED, 'При отказе от задачи возвращается корректный статус');

$nextStatus = $task->getNextStatus(Task::ACTION_CANCEL);
assert($nextStatus === Task::STATUS_CANCELED, 'При отмене задачи возвращается корректный статус');

$nextStatus = $task->getNextStatus(Task::ACTION_START);
assert($nextStatus === Task::STATUS_PROCESSING, 'При старте задачи возвращается корректный статус');

$nextStatus = $task->getNextStatus(Task::ACTION_FINISH);
assert($nextStatus === Task::STATUS_FINISHED, 'При завершении задачи возвращается корректный статус');


