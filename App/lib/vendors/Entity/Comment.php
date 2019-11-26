<?php
declare(strict_types=1);

namespace App\lib\vendors\Entity;

use App\lib\OCFram\Entity;

class Comment extends Entity
{
    /**
     * @var
     */
    protected $id;

    /**
     * @var
     */
    protected $news;

    /**
     * @var
     */
    protected $auteur;

    /**
     * @var
     */
    protected $contenu;

    /**
     * @var
     */
    protected $date;

    const AUTEUR_INVALIDE = 1;
    const CONTENU_INVALIDE = 2;

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return !(empty($this->auteur) || empty($this->contenu));
    }

    /**
     * @param int $news
     */
    public function setNews(int $news): void
    {
        $this->news = $news;
    }

    /**
     * @param string $auteur
     * @return int
     */
    public function setAuteur(string $auteur)
    {
        if (!is_string($auteur) || empty($auteur)) {
            return $this->erreurs[] = self::AUTEUR_INVALIDE;
        }

        $this->auteur = $auteur;
    }

    /**
     * @param string $contenu
     * @return int
     */
    public function setContenu(string $contenu)
    {
        if (!is_string($contenu) || empty($contenu)) {
            return $this->erreurs[] = self::CONTENU_INVALIDE;
        }

        $this->contenu = $contenu;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getNews(): int
    {
        return $this->news;
    }

    /**
     * @return string
     */
    public function getAuteur(): string
    {
        return $this->auteur;
    }

    /**
     * @return string
     */
    public function getContenu(): string
    {
        return $this->contenu;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}