<?php
declare(strict_types=1);

namespace App\lib\OCFram;

class PDOFactory
{
    /**
     * @return \PDO
     */
    public static function getMySqlConnexion()
    {
        $db = new \PDO('mysql:host=localhost;dbname=news', 'root', '');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }
}