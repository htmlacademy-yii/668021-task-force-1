<?php
namespace App\Models;

class City
{
    public $id;
    public $name;
    public $lat;
    public $long;

    const NAME_TABLE = 'cities';
}
