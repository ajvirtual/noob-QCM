<?php
namespace Applications\Backend\Modules\News;

class NewsController extends \Library\BackController
{
    public function executeIndex(\Library\HTTPRequest $request) {
        $this->page->addVar('title', 'Gestion des news');
        $manager = $this->managers->getManagerOf('News');
        $this->page->addVar('listeNews', $manager->getListe());
        $this->page->addVar('nombreNews', $manager->count());
    }
    
    public function executeInsert(\Library\HTTPRequest $request) {
        if ($request->postExists('auteur')) {
            $this->processForm($request);
        }
        $this->page->addVar('title', 'Ajout d\'une news');
    }

    public function processForm(\Library\HTTPRequest $request) {
        $news = new \Library\Entities\News([
            'auteur' => $request->postData('auteur'),
            'titre' => $request->postData('titre'),
            'contenu' => $request->postData('contenu')
        ]);
        // L'identifiant de la news est transmis si on veut la modifier.
        if ($request->postExists('id')) {
            $news->setId($request->postData('id'));
        }
        if ($news->isValid()) {
            $this->managers->getManagerOf('News')->save($news);
            $this->app->user()->setFlash($news->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !');
        } else {
            $this->page->addVar('erreurs', $news->erreurs());
        }   
        $this->page->addVar('news', $news);
    }

    public function executeUpdate(\Library\HTTPRequest $request) {
        if ($request->postExists('auteur')) {
            $this->processForm($request);
        } else {
            $this->page->addVar('news', $this->managers->getManagerOf('News')->getUnique($request->getData('id')));
        }
            $this->page->addVar('title', 'Modification d\'une news');
    }

    public function executeDelete(\Library\HTTPRequest $request) {
        $this->managers->getManagerOf('News')->delete($request->getData('id'));
        $this->app->user()->setFlash('La news a bien été supprimée !');
        $this->app->httpResponse()->redirect('.');
    }

    public function executeUpdateComment(\Library\HTTPRequest $request) {
        $this->page->addVar('title', 'Modification d\'un commentaire');
        if ($request->postExists('pseudo')) {
            $comment = new \Library\Entities\Comment(array(
                'id' => $request->getData('id'),
                'auteur' => $request->postData('pseudo'),
                'contenu' => $request->postData('contenu')
            ));
            if ($comment->isValid()) {
                $this->managers->getManagerOf('Comments')->save($comment);
                $this->app->user()->setFlash('Le commentaire a bien été modifié !');
                $this->app->httpResponse()->redirect('/news-'.$request->postData('news').'.php');
            } else {
                $this->page->addVar('erreurs', $comment->erreurs());
            }
             $this->page->addVar('comment', $comment);
        } else {
            $this->page->addVar('comment', $this->managers->getManagerOf('Comments')->get($request->getData('id')));
        }
    }

    public function executeDeleteComment(\Library\HTTPRequest $request) {
        $this->managers->getManagerOf('Comments')->delete($request->getData('id'));
        $this->app->user()->setFlash('Le commentaire a bien été supprimé
        !');
        $this->app->httpResponse()->redirect('.');
    }

    public function executeDeconnect(\Library\HTTPRequest $request) {
        $this->app->user()->setAuthenticated(false);
        $this->app->httpResponse()->redirect('/');
    }
}
?>