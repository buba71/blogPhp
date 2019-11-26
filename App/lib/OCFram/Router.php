<?php
declare(strict_types=1);

namespace App\lib\OCFram;

class Router
{
    const NO_ROUTE = 1;

    protected $routes = [];

    /**
     * @param Route $route
     */
    public function addRoute(Route $route): void
    {
        if (!in_array($route, $this->routes)) {
            $this->routes[] = $route;
        }
    }

    public function getRoute($url)
    {
        foreach ($this->routes as $route) {
            // Does route match URL.
            if (($varsValues = $route->match($url)) !== false) {
                // Does route has Vars.
                if ($route->hasVars()) {
                    $varNames = $route->getVarsNames();
                    $listVars = [];

                    // Create a new array with key=>Value.
                    // (Key = Var name, Value = Its value).
                    foreach ($varsValues as $key => $match) {
                        // The first value contain the entire string captured(voir preg_match).
                        if ($key !== 0) {
                            $listVars[$varNames[$key - 1]] = $match;
                        }
                    }
                    // Assign array vars to route.
                    $route->setVars($listVars);
                } else {
                    $route->setVars([]);
                }
                return $route;
            }
        }

        throw new \RuntimeException("Aucune route ne correspond à l\'URL", self::NO_ROUTE);
    }


}