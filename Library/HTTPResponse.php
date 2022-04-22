<?php
    namespace Library;
    class HTTPResponse extends ApplicationComponent {
        protected $page;
        public function addHeader($header) {
            header($header);
        }

        public function redirect($location) {
            header('Location:'.$location);
            exit;
        }

        public function redirect404() {
            $this->page = new Page($this->app);

            // $this->addHeader('HTTP/1.0 404 Not Found');
            $this->page->setContentFile(__DIR__.'/../Errors/404.html');
            $this->send();

            // $this->redirect("../Errors/404.html");
            // exit;

        }

        public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true) {
            setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);            
        }

        public function send() {
            exit($this->page->getGeneratedPage());
        }

        public function setPage(Page $page) {
            $this->page = $page;
        }
    }