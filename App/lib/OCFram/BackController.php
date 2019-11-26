<?php
declare(strict_types=1);

namespace App\lib\OCFram;

abstract class BackController extends ApplicationComponent
{
    protected $action = '';
    protected $module = '';
    protected $page = null;
    protected $view = '';
    protected $managers = null;

    /**
     * BackController constructor.
     * @param Application $app
     * @param $module
     * @param $action
     */
    public function __construct(Application $app, string $module, string $action)
    {
        parent::__construct($app);

        $this->managers = new Managers('PDO', PDOFactory::getMySqlConnexion());
        $this->page = new Page($app);

        $this->setModule($module);
        $this->setAction($action);
        $this->setView($action);
    }

    /**
     *
     */
    public function execute(): void
    {
        $method = 'execute'.ucfirst($this->action);

        if (!is_callable([$this, $method])) {
            throw new \RuntimeException('L\'action "'.$this->action.'" n \'est pas définie sur ce module');
        }

        $this->$method($this->app->getHttpRequest());
    }

    /**
     * @return Page|null
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param string $module
     */
    public function setModule(string $module): void
    {
        if (!is_string($module) || empty($module)) {
            throw new \InvalidArgumentException('Le module doit être une chaine de caractères valides.');
        }

        $this->module = $module;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void
    {
        if (!is_string($action) || empty($action)) {
            throw new \InvalidArgumentException('L\'action doit être une chaine de caractères valides.');
        }

        $this->action = $action;
    }

    /**
     * @param string $view
     */
    public function setView(string $view): void
    {
        if (!is_string($view) || empty($view)) {
            throw new \InvalidArgumentException('La vue doit être une chaine de caractères valides.');
        }

        $this->view = $view;

        $this->page
            ->setContentFile(
                __DIR__.'/../../'.$this->app->getName().'/Modules/'.$this->module.'/Views/'.$this->view.'.php'
            );
    }


}