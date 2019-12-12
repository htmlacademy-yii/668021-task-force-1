<?php

namespace App\Models;

/*
 * Скелет ActiveRecord для демонстрации работы модели сущности
 * */

class User {

    public $id;
    public $name;
    public $email;
    public $address;
    public $avatar;
    public $birthday;
    public $info;
    public $password;
    public $contact_phone;
    public $contact_skype;
    public $contact_other;
    public $creation_time;
    public $last_visited_time;
    public $count_views;
    public $show_contacts_costumers;

    const NAME_TABLE = 'users';

    public function save() {
        // Сохранение значений свойств в БД.
        // Если есть существует id, то выполняется запрос UPDATE строчки, где id соответствует id свойству столбца.
        // Если не существует, то выполняется запрос INSERT, добавление новой записи.
    }

    public function delete() {
        // Удаляет запись с существующей id.
    }

    public function validate() {
        // Проверяет, все ли свойства соответствуют правилам валидации.
    }

}
