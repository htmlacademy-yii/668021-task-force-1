<?php

use App\Models\Actions;
use App\Models\Task;
use App\Exception\StatusException;


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

$nextStatus = $task->getNextStatus(Actions\ActionNew::getName());
assert($nextStatus === Task::STATUS_NEW, 'При создании задачи возвращается корректный статус');

$nextStatus = $task->getNextStatus(Actions\ActionFail::getName());
assert($nextStatus === Task::STATUS_FAILED, 'При отказе от задачи возвращается корректный статус');

$nextStatus = $task->getNextStatus(Actions\ActionCancel::getName());
assert($nextStatus === Task::STATUS_CANCELED, 'При отмене задачи возвращается корректный статус');

$nextStatus = $task->getNextStatus(Actions\ActionStart::getName());
assert($nextStatus === Task::STATUS_PROCESSING, 'При старте задачи возвращается корректный статус');

$nextStatus = $task->getNextStatus(Actions\ActionFinish::getName());
assert($nextStatus === Task::STATUS_FINISHED, 'При завершении задачи возвращается корректный статус');


// Проверка метода accessActions

$listActions = $task->accessActions(Task::STATUS_NEW, 8);
$listActions = $task->accessActions(Task::STATUS_NEW, 5);
$listActions = $task->accessActions(Task::STATUS_PROCESSING, 5);
$listActions = $task->accessActions(Task::STATUS_FAILED, 8);
$listActions = $task->accessActions(Task::STATUS_FINISHED, 5);


// Проверка подачи несуществующего статуса
try {
    $listActions = $task->accessActions('STATUS_FIRE', 5);
} catch (StatusException $ex) {
    echo $ex->getMessage();
}


$file = new SplFileObject("data\categories.csv");
while (!$file->eof()) {
    var_dump($file->fgetcsv());
}


