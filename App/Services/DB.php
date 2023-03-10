<?php

namespace App\Services;

use PDO;

class DB
{
    public static function insert($table, array $data): void
    {
        $query = "insert into " . $table . self::prepareValue($data)['key'] . " values" . self::prepareValue($data)['value'];
        $insert = DB::connect()->prepare($query);
        foreach ($data as $key => $value) {
            $insert->bindValue(":" . $key, $value);
        }
        $insert->execute();
    }

    public static function prepareValue(array $data): array
    {
        $res['key'] = "(" . htmlspecialchars(implode(', ', array_keys(($data)))) . ")";
        $res['value'] = "( :" . htmlspecialchars(implode(', :', array_keys(($data)))) . ")";
        return $res;
    }

    public static function connect(): PDO
    {
        $config = require_once 'config/db.php';
            $pdo = new PDO("mysql:host={$config['host']};dbname={$config['db_name']};port=3306", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
    }

    public static function select($table, $row = "*", $condition = "", $isSingle = false)
    {
        //select * from users where id=1
        $query = "select {$row} from {$table}";
        $query .= $condition ? " where $condition" : "";
        $select = DB::connect()->prepare($query);
        $select->execute();
        return $isSingle ? $select->fetch(PDO::FETCH_ASSOC) : $select->fetchAll(PDO::FETCH_ASSOC);
    }

}