<?php
    namespace Library;

   abstract class Application {
        protected $httpRequest;
        protected $httpResponse;
        protected $name;
        protected $user;

        public function __construct() {
            $this->httpRequest = new HTTPRequest($this);
            $this->httpResponse = new HTTPResponse($this);
            $this->name = '';
            $this->user = $this->user();
        }

        public function getController() {
           $router = new \Library\Router;

            $xml = new \DOMDocument;
            $xml->load(__DIR__.'/../Applications/'.$this->name.'/Config/routes.xml');

            $routes = $xml->getElementsByTagName('route');
            // On parcourt les routes du fichier XML.
            foreach ($routes as $route) {
                $vars = array();
                // On regarde si des variables sont presentes dans l'URL.
                if($route->hasAttribute('vars')) {
                    $vars = explode(',', $route->getAttribute('vars'));
                }

                // On ajoute la route au routeur.
                $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
            }

            try {
                //On recupere la route correspondante a l'url
                $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
            } catch (\RuntimeException $e) {
                if($e->getCode() == \Library\Router::NO_ROUTE) {
                    // Si aucune route ne correspond, c'est que la page demandee n'existe pas.
                    $this->httpResponse->redirect404();
                }   
            }

                // On ajoute les variables de l'URL au tableau $_GET.
                $_GET = array_merge($_GET, $matchedRoute->vars());
                // On instancie le controleur. 
                $controllerClass = 'Applications\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';

                return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
        }

        abstract public function run();

        public function user() {
            return new User($this); 
        }

        public function httpRequest() {
            return $this->httpRequest;
        }

        public function httpResponse() {
            return $this->httpResponse;
        }

        public function name() {
            return $this->name;
        }
        
        // CUSTOM
        public function config() {
            return new \Library\Config($this);
        }
        // CUSTOM
    }
?>