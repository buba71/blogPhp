<?php
declare(strict_types=1);

namespace App\Frontend;

use App\lib\OCFram\Application;

class FrontendApplication extends Application
{
    /**
     * FrontendApplication constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->name = 'Frontend';
    }

    /**
     * @return mixed|void
     */
    public function run(): void
    {
        $controller = $this->getController();
        $controller->execute();

        $this->httpResponse->setPage($controller->getPage());
        $this->httpResponse->send();
    }


}