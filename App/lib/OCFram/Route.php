<?php
declare(strict_types=1);

namespace App\lib\OCFram;

class Route
{
    protected $action;
    protected $module;
    protected $url;
    protected $varsNames;
    protected $vars;

    /**
     * Route constructor.
     * @param string $url
     * @param string $module
     * @param string $action
     * @param array $varNames
     */
    public function __construct(string $url, string $module, string $action, array $varsNames)
    {
        $this->setUrl($url);
        $this->setModule($module);
        $this->setAction($action);
        $this->setVarsNames($varsNames);
    }

    /**
     * @return bool
     */
    public function hasVars(): bool
    {
        return !empty($this->varsNames);
    }

    /**
     * @param $url
     * @return bool
     */
    public function match($url)
    {
        if (preg_match('`^'.$this->url.'$`', $url, $matches)) {
            return $matches;
        } else {
            return false;
        }
    }

    /**
     * @param $action
     */
    public function setAction($action): void
    {
        if (is_string($action)) {
            $this->action = $action;
        }
    }

    /**
     * @param $module
     */
    public function setModule($module): void
    {
        if (is_string($module)) {
            $this->module = $module;
        }
    }

    /**
     * @param $url
     */
    public function setUrl($url): void
    {
        if (is_string($url)) {
            $this->url = $url;
        }
    }

    /**
     * @param array $varsNames
     */
    public function setVarsNames(array $varsNames): void
    {
        $this->varsNames = $varsNames;
    }

    /**
     * @param array $vars
     */
    public function setVars(array $vars): void
    {
        $this->vars = $vars;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return$this->action;
    }

    /**
     * @return string
     */
    public function getModule(): string
    {
        return $this->module;
    }

    /**
     * @return array
     */
    public function getVars(): ?array
    {
        return $this->vars;
    }

    /**
     * @return array
     */
    public function getVarsNames(): array
    {
        return $this->varsNames;
    }

}