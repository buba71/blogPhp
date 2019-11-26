<?php
declare(strict_types=1);

namespace App\lib\OCFram;

class Page extends ApplicationComponent
{
    protected $contentFile;
    protected $vars = [];

    /**
     * @param $var
     * @param $value
     */
    public function addVar(string $var, $value): void
    {
        if (!is_string($var) || is_numeric($var) || empty($var)) {
            throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractères non nulle.');
        }

        $this->vars[$var] = $value;
    }

    /**
     * @return false|string
     */
    public function getGeneratedPage()
    {

        if (!file_exists($this->contentFile)) {
            throw new \RuntimeException('La vue spécifiée n\'éxiste pas.');
        }

        // $user = $this->app->user();

        extract($this->vars);



        ob_start();
        require $this->contentFile;


        $content = ob_get_clean();

        ob_start();

        require __DIR__.'/../../'. $this->app->getName() . '/Templates/layout.php';

        return ob_get_clean();
    }

    /**
     * @param string $contentFile
     */
    public function setContentFile(string $contentFile): void
    {
        if (!is_string($contentFile) || empty($contentFile)) {
            throw new \InvalidArgumentException('La vue spécifiée n\'est pas valide');
        }

        $this->contentFile = $contentFile;
    }
}
