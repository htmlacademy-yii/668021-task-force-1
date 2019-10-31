<?php

abstract class ActionClass {
    abstract public static function getName();
    abstract public static function checkRules(string $role, int $user_id);
    abstract public static function getInnerName();
}

class ActionCancel extends ActionClass {

    public static function getName()
    {
        // TODO: Implement getName() method.
        return 'ACTION_CANCEL';
    }

    public static function getInnerName()
    {
        // TODO: Implement getInnerName() method.
    }

    public static function checkRules(string $role, int $user_id)
    {
        // TODO: Implement checkRules() method.
        // Проверить, что задача находится в статусе "Новая" (Непонятно, а как узнать статус?)
        // Проверить, что инициатор отмены является в роли "Заказачик"
        // Вернуть значение true, если все ок, иначе значение false
    }

}

class ActionStart {

    public static function getName()
    {
        // TODO: Implement getName() method.
        return 'ACTION_START';
    }

    public static function getInnerName()
    {
        // TODO: Implement getInnerName() method.
    }

    public static function checkRules()
    {
        // TODO: Implement checkRules() method.
    }

}

class ActionFinish {

    public static function getName()
    {
        // TODO: Implement getName() method.
        return 'ACTION_FINISH';
    }

    public static function getInnerName()
    {
        // TODO: Implement getInnerName() method.
    }

    public static function checkRules()
    {
        // TODO: Implement checkRules() method.
    }

}

class ActionFail {

    public static function getName()
    {
        // TODO: Implement getName() method.
        return 'ACTION_FAIL';
    }

    public static function getInnerName()
    {
        // TODO: Implement getInnerName() method.
    }

    public static function checkRules()
    {
        // TODO: Implement checkRules() method.
    }


}

class ActionNew {

    public static function getName()
    {
        // TODO: Implement getName() method.
        return 'ACTION_NEW';
    }

    public static function getInnerName()
    {
        // TODO: Implement getInnerName() method.
    }

    public static function checkRules()
    {
        // TODO: Implement checkRules() method.
    }


}
