<?php
declare(strict_types=1);

namespace App\lib\OCFram;

class HTTPResponse extends ApplicationComponent
{
    protected $page;

    /**
     * @param $header
     */
    public function addHeader($header): void
    {
        header($header);
    }

    /**
     * @param string $location
     */
    public function redirect(string $location): void
    {
        header('location:' . $location);
        exit;
    }

    public function redirect404()
    {
        $this->page = new Page($this->app);
        $this->page->setContentFile(__DIR__.'/../../Errors/404.html');

        $this->addHeader('HTTP/1.0 404 Not Found');
    }

    /**
     *
     */
    public function send(): void
    {
        exit($this->page->getGeneratedPage());
    }

    /**
     * @param Page $page
     */
    public function setPage(Page $page): void
    {
        $this->page = $page;
    }

    /**
     * @param string $name
     * @param string $value
     * @param int $expire
     * @param string|null $path
     * @param string|null $domain
     * @param bool $secure
     * @param bool $httpOnly
     */
    public function setCookie(string $name, string $value = '', $expire = 0, string $path = null, string $domain = null, bool $secure = false, bool $httpOnly = true): void
    {
        setCookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }

}