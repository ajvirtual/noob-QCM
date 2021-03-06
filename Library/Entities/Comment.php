<?php
namespace Library\Entities;

class Comment extends \Library\Entity {
    protected $news, $auteur, $contenu, $date;

    const AUTEUR_INVALIDE = 1;
    const CONTENU_INVALIDE = 2;

    public function isValid() {
        return !(empty($this->auteur) || empty($this->contenu));
    }

    // SETTERS

    public function setNews($news) {
        $this->news = (int) $news;
    }

    public function setAuteur($auteur) {
        if(!is_string($auteur) || empty($auteur)) {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        } else {
            $this->auteur = $auteur;
        }

    }

    public function setContenu($contenu) {
        if(!is_string($contenu) || empty($contenu)) {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        } else {
            $this->contenu = $contenu;
        }
    }

    public function setDate(\DateTime $date) {
        $this->date = $date;
    }

    // GETTERS

    public function news() {
        return $this->news;
    }

    public function auteur() {
        return $this->auteur;
    }

    public function contenu() {
        return $this->contenu;
    }

    public function date() {
        return $this->date;
    }
}