<?php
declare(strict_types=1);

namespace App\lib\OCFram;

class Config extends ApplicationComponent
{
    protected $vars = [];

    public function get($var)
    {
        if (!$this->vars) {
            $xml = new \DOMDocument;
            $xml->load(__DIR__.'/../../'.$this->app->getName().'/config/app.xml');

            $elements = $xml->getElementsByTagName('define');

            foreach ($elements as $element) {
                // On récupère la clé, valeur des paramètres du fichier app.xml.
                $this->vars[$element->getAttribute('var')] = $element->getAttribute('value');
            }
        }
        if (isset($this->vars[$var])) {
            return $this->vars[$var];
        }

        return null;
    }
}