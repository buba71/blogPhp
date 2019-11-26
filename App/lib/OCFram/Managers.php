<?php
declare(strict_types=1);

namespace App\lib\OCFram;

class Managers
{
    protected $api = null;
    protected $dao = null;
    protected $managers = [];

    public function __construct($api, $dao)
    {
        $this->api = $api;
        $this->dao = $dao;
    }

    /**
     * @param $module
     * @return mixed
     */
    public function getManagerOf($module)
    {
        if (!is_string($module) || empty($module)) {
            throw new \InvalidArgumentException('Le module spécifiéest invalide.');
        }

        if (!isset($this->managers[$module])) {
            $manager = '\App\lib\vendors\Model\\'.$module.'Manager'.$this->api;
            $this->managers[$module] = new $manager($this->dao);
        }

        return $this->managers[$module];
    }
}