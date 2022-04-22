<?php
    namespace Library;

    class Router {
        protected $routes = [];

        const NO_ROUTE = 1;

        public function addRoute(Route $route) {
            if(!in_array($route, $this->routes)) {
                $this->routes[] = $route;
            }
        }

        public function getRoute($url) {
            foreach($this->routes as $route) {
                // Si la route correspond a l'URL.
                if(($varsValues = $route->match($url)) !== false) {
                    // Si elle a des variables.
                    if($route->hasVars()) {
                        $varsNames = $route->varsNames();
                        $listVars = array();

                        // On cree un nouveau tableau cle/valeur.
                        // (Cle = nom de la variable, valeur = sa valeur.)
                        foreach ($varsValues as $key => $match  ) {
                            // La premiere valeur contient entierement la chaine capturee (voir la doc sur preg_match).
                            if($key !== 0) {
                                $listVars[$varsNames[$key - 1]] = $match;
                            }
                        }

                        // On assigne ce tableau de variable a la route.
                        $route->setVars($listVars);
                    }

                    return $route;
                    
                }
            }

            throw new \RuntimeException('Aucune route ne correspond a l\'URL', self::NO_ROUTE);
        }
    }
?>