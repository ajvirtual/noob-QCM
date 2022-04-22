<?php 
namespace Library\Models;

use \Library\Entities\Comment;

abstract class commentsManager extends \Library\Manager {
    /**
     * Methode permettant d'ajouter un commentaire
     * @param $comment Le commentaire a ajouter
     * @return void
     */
    abstract protected function add(Comment $comment);

    /**
     * Methode permettant d'enregistrer un commentaire.
     * @param $comment Le commentaire a enregistrer
     * @return void
     */

     public function save(Comment $comment) {
         if($comment->isValid()) {
             $comment->isNew() ? $this->add($comment) : $this->modify($comment);
         } else {
             throw new \RuntimeException('Le commentaire doit etre valide pour etre enregistre');
         }
     }

     /**
      * Methode permettant de recuperer une liste de commentaires.
      * @param $news La news sur laquelle on veut recuperer les commentares
      * @return array
      */

      abstract public function getListOf($news);

    /**   
    * Méthode permettant de modifier un commentaire.
    * @param $comment Le commentaire à modifier
    * @return void
    */
    abstract protected function modify(Comment $comment);
    /**
    * Méthode permettant d'obtenir un commentaire spécifique.
    * @param $id L'identifiant du commentaire
    * @return Comment
    */
    abstract public function get($id);

    /**
    * Méthode permettant de supprimer un commentaire.
    * @param $id L'identifiant du commentaire à supprimer
    * @return void
    */

    abstract public function delete($id);

}
