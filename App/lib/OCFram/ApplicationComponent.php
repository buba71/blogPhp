<?php
declare(strict_types=1);

namespace App\lib\OCFram;

abstract class ApplicationComponent
{
    protected $app;

    /**
     * ApplicationComponent constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @return Application
     */
    public function getApp(): Application
    {
        return $this->app;
    }
}