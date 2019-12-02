<?php
namespace App\Conversion;


class ConversionCVS
{

    private $heads;
    private $values;
    private $convert_arrays_cvs;

    private $file_csv;
    private $file_sql;


    public function __construct(string $file)
    {
        $this->file_csv = new \SplFileObject($file);
        $this->file_sql = new \SplFileObject('categories.sql','w');
    }
    // 1. Открыть нужный файл CVS
    // 2. Преобразовывать кажду строку с помощью класса SplFileObject
    // 3. Для каждой сущности создать метод, который будет преоборзовывать данные CVS в строки sql "INSERT"

    // Алгоритм разбора/преобразование строки на примере categories
    // Извлекаем данные из первой строки для сущности Category: name и icon, и сохраняем их в переменные. Это будут названия столбцов

    // Основная функция разбора строки.
    public function parsing_cvs()
    {
        $this->heads = $this->file_csv->fgetcsv();
        while (!$this->file_csv->eof()) {
            $this->values = $this->file_csv->fgetcsv();
            if ($this->values[0] !== null) {
                $this->file_sql->fwrite($this->convert_cvs_to_sql()."\r\n");
            }
        }
    }

    private function convert_cvs_to_sql(): string
    {
        $sql_string = "INSERT INTO categories SET ".(string)$this->heads[0]." = ".(string)$this->values[0].", ".(string)$this->heads[1]." = ".(string)$this->values[1];
        return $sql_string;
    }

    //$file->fgetcsv()
    // Начиная со второй строки извлекаем значения name и icon, сохраняем их в соответствующие переменные.
    // Создаем новую строку вид private sql_into = "INSERT INTO categories SET $name=$name_value, $icon=$icon_value";
    // Записываем эту строку в новый файл с таким же названием, но другим расширением *.sql


    /* Свойства:
     * 1.Массив для хранения имен столбцов
     * 2.Массив для хранения значений столбоц.
     * 3.Массив для хранения массивов с преобразованными строками
     *
     * Методы:
     * 1. Метод извлечения строки.
     * 2. Метод записи в строку.
     * 3. Метод создания
     */


}
