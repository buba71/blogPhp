<?php
declare(strict_types=1);

namespace App\lib\OCFram;

abstract class Manager
{
    protected $dao;

    /**
     * Manager constructor.
     * @param $dao
     */
    public function __construct($dao)
    {
        $this->dao = $dao;
    }
}