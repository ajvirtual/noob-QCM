<?php
namespace Library\Models;

use \Library\Entities\News;

abstract class NewsManager extends \Library\Manager {
    /**
     * Methode retournant une liste de news demandee
     * @param $debut int la premiere news a selectionner
     * @param $limite int Le nombre de news a selectionner
     * @return array La liste des news. Chaque entree est une instance de News.
     */

    abstract public function getListe($debut = -1, $limite = -1);

     /**
      * Methode retournant une news precise.
      * @param $id int L'identifiant de la news a recuperer
      * @return News La news demandee
      */

    abstract public function getUnique($id);

    abstract protected function add(News $news);

      /**
    * Méthode renvoyant le nombre de news total.
    * @return int
    */
    abstract public function count();

    /**
    * Méthode permettant d'enregistrer une news.
    * @param $news News la news à enregistrer
    * @see self::add()
    * @see self::modify()
    * @return void
    */
    public function save(News $news) {
        if ($news->isValid()) {
             $news->isNew() ? $this->add($news) : $this->modify($news);
        } else {
            throw new \RuntimeException('La news doit être validée pour
            être enregistrée');
        }
    }

    abstract protected function modify(News $news);


    /**
    * Méthode permettant de supprimer une news.
    * @param $id int L'identifiant de la news à supprimer
    * @return void 
    */
    abstract public function delete($id);
}