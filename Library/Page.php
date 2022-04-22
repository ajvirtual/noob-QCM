<?php
namespace Library;

class Page extends ApplicationComponent {
    protected $contentFile;
    protected $vars = array();

    public function addVar($var, $value) {
        if(!is_string($var) || is_numeric($var) || empty($var)) {
            throw new \InvalidArgumentException('Le nom de la variable doit etre une chaine de caractere non nulle');
        }

        $this->vars[$var] = $value;
    }

    public function getGeneratedPage() {
        if(!file_exists($this->contentFile)) {
            throw new \RuntimeException('La vue specifiee n\'existe pas');
        }
        $user = $this->app->user();
        // $user->setAuthenticated(false);
        
        extract($this->vars);

        ob_start();
            require $this->contentFile;
        $content = ob_get_clean();

        ob_start();
            require __DIR__.'/../Applications/'.$this->app->name().'/Templates/layout.php';
        return ob_get_clean();
    }

    public function setContentFile($contentFile) {
        // if(!is_string($contentFile) || empty($contentFIle)) {
        //     throw new \InvalidArgumentException('La vue specifiee est invalide');
        // }

        $this->contentFile = $contentFile;
    }
}
?>