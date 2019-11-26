<?php
declare(strict_types=1);

namespace App\lib\OCFram;

abstract class Application
{
    protected $config;
    protected $httpRequest;
    protected $httpResponse;
    protected $name;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->config = new Config($this);
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);

        $this->name = '';
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        $router = new Router;

        $xml = new \DOMDocument();
        $xml->load(__DIR__.'/../../'.$this->name.'/config/routes.xml');

        $routes = $xml->getElementsByTagName('route');

        // Browse the routes of xml file.
        foreach ($routes as $route) {
            $vars = [];

            // Check if URL contains vars.
            if ($route->hasAttribute('vars')) {
                $vars = explode(',', $route->getAttribute('vars'));
            }

            // Add route to the router class.
            $router->addRoute(
                new Route(
                    $route->getAttribute('url'),
                    $route->getAttribute('module'),
                    $route-> getAttribute('action'),
                    $vars
                )
            );
        }

        try {
            // Retrieve route corresponding to URL.
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        } catch (\RuntimeException $e) {
            if ($e->getCode() == Router::NO_ROUTE) {
                // If route not match, route doesn't exist.
                $this->httpResponse->redirect404();
            }
        }

        // Add vars of URL to $_GET array.
        $_GET = array_merge($_GET, $matchedRoute->getVars());

        // Instantiate controller.
        $controllerClass =
            'App\\'.$this->name.'\\Modules\\'.$matchedRoute->getModule().'\\'.$matchedRoute->getModule().'Controller';

        return new $controllerClass($this, $matchedRoute->getModule(), $matchedRoute->getAction());
    }

    /**
     * @return mixed
     */
    abstract public function run();

    /**
     * @return HTTPRequest
     */
    public function getHttpRequest(): HTTPRequest
    {
        return $this->httpRequest;
    }

    /**
     * @return HTTPResponse
     */
    public function getHttpResponse(): HTTPResponse
    {
        return $this->httpResponse;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Config
     */
    public function config(): Config
    {
        return $this->config;
    }
}