<?php
declare(strict_types=1);

namespace App\lib\vendors\Entity;

use App\lib\OCFram\Entity;

class News extends Entity
{
    protected $auteur;
    protected $titre;
    protected $contenu;
    protected $dateAjout;
    protected $dateModif;

    const AUTHEUR_INVALIDE = 1;
    const TITRE_INVALIDE = 2;
    const CONTENU_INVALIDE = 3;

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return !(empty($this->auteur) || empty($this->titre) || empty($this->contenu));
    }


    /**
     * @param string $auteur
     */
    public function setAutheur(string $auteur): void
    {
        if (!is_string($auteur) || empty($auteur)) {
            $this->erreurs[] = self::AUTHEUR_INVALIDE;
        }

        $this->auteur = $auteur;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre) : void
    {
        if (!is_string($titre) || empty($titre)) {
            $this->erreurs[] = self::TITRE_INVALIDE;
        }

        $this->titre = $titre;
    }

    /**
     * @param string $contenu
     */
    public function setContenu(string $contenu): void
    {
        if (!is_string($contenu) || empty($contenu)) {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        }

        $this->contenu =$contenu;
    }

    /**
     * @param \DateTime $dateAjout
     */
    public function setDateAjout(\DateTime $dateAjout): void
    {
        $this->dateAjout = $dateAjout;
    }

    /**
     * @param \DateTime $dateModif
     */
    public function setDateModif(\DateTime $dateModif): void
    {
        $this->dateModif = $dateModif;
    }

    // GETTERS //

    /**
     * @return string
     */
    public function auteur(): string
    {
        return $this->auteur;
    }

    /**
     * @return string
     */
    public function titre(): string
    {
        return $this->titre;
    }

    /**
     * @return string
     */
    public function contenu(): string
    {
        return $this->contenu;
    }

    /**
     * @return DateTime
     */
    public function dateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * @return DateTime
     */
    public function dateModif()
    {
        return $this->dateModif;
    }
}
