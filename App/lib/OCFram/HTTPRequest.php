<?php
declare(strict_types=1);

namespace App\lib\OCFram;

class HTTPRequest extends ApplicationComponent
{
    /**
     * @param string $key
     * @return string|null
     */
    public function cookieData(string $key): ?string
    {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function cookieExist(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function getData(string $key): ?string
    {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function getExist(string $key): bool
    {
        return isset($GET[$key]);
    }

    /**
     *
     */
    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function postData(string $key): ?string
    {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function postExist(string $key): bool
    {
        return isset($_POST[$key]);
    }

    /**
     * @return string
     */
    public function requestURI(): string
    {
        return $_SERVER['REQUEST_URI'];
    }


}