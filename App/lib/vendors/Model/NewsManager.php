<?php
declare(strict_types=1);

namespace App\lib\vendors\Model;

use App\lib\OCFram\Manager;

abstract class NewsManager extends Manager
{
    /**
     * @param int $debut
     * @param int $limite
     * @return mixed
     */
    abstract public function getList($debut = -1, $limite = -1);
}
