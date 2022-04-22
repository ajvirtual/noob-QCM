<?php
namespace Applications\Frontend\Modules\Main;

use Applications\Frontend\Config\qcmParam;
use Exception;

class MainController extends \Library\BackController {
    
    public $qP;


    // private static $currentQcm = ;
    // private static $score = $_SESSION['score'];
   
    public function executeIndex() {
        qcmParam::initParamQcm();
    }

    public function executePlay() {
        $this->nextQuestion();
        $this->page->addVar('css', 'play.css');
        $this->qP = new qcmParam();
        try {
            $score = $this->qP->jsonParam();
        } catch(Exception $e) {
            echo $e->getMessage();
        }

        $tab = $this->qP->tab;
        if(isset($tab[$score['current']]['form'])) {
            $form = $tab[$score['current']]['form'];
        } else {
            $this->app->user()->setFlash('c\'est fini');
            $this->app->httpResponse()->redirect('/result');
        }
        $rep = $tab[$score['current']]['rep'];
        $query = $tab[$score['current']]['query'];
        
        // $form = [
        //     'value' => ['blanc', 'rouge', 'bleu ciel', 'vert', 'jaune', 'violet', 'noir'],
        //     'id_prefix' => 'id2',
        //     'submit' => 'submit'
        // ];
        // $rep = ['jaune', 'bleu ciel', 'noir'];
        // $query = 'quelles sont mes couleurs preferes';

        $this->page->addVar('js', 'play.js');
        $this->page->addVar('query', $query);
        $this->page->addVar('answer', $rep);
        $this->page->addVar('form', $form);

        isset($score) ? $this->page->addVar('score', $score) : '';
        
        if(isset($_POST['submit'])) {
            if(isset($_POST['choice'])) {
               if(count($rep) === 1) {

                    if($_POST['choice'] === $rep) {
                        $this->page->addVar('verdict', '<h3 style="color:green" class="truth">vrai</h3>');
                        $this->qP->incrementeScore();
                        // $this->page->addVar('js', 'play.js');
                        $this->app->httpResponse()->redirect('/play');
                    } else {
                        $this->page->addVar('verdict', '<h3 style="color:red">faux</h3>' );
                    }

               } else {
                    $repCount = count($rep);        
                    $nbtrue = 0;
                    if(count($_POST['choice']) <= count($rep)) {
                        foreach($_POST['choice'] as $choice) {
                            if(in_array($choice, $rep)) {
                                $nbtrue++;
                            }
                        }  
                    } else {
                        foreach($_POST['choice'] as $choice) {
                            if(in_array($choice, $rep)) {
                                $nbtrue++;
                            } else {
                                $nbtrue = 0;
                            }
                        }
                    }
                  
                    if($repCount === $nbtrue) {
                        $this->page->addVar('verdict', '<h3 style="color:green" class="truth">vrai</h3>' );
                        $this->qP->incrementeScore();
                        // $this->page->addVar('js', 'play.js');
                        $this->app->httpResponse()->redirect('/play');

                    } elseif($nbtrue == $repCount - 1) {
                        $this->page->addVar('verdict', '<h3 style="color:blue" >presque</h3>' );
                    } else {
                        $this->page->addVar('verdict', '<h3 style="color:red" >faux</h3>' );
                    }
               }  

            } else {
                $this->page->addVar('verdict', '<h3 style="color:blue">vous devez faire votre choix</h3>' );
            }
        }
    }

    public function executeResult() {
        $this->qP = new qcmParam();
        $score = $this->qP->jsonParam();
        $this->page->addVar('score', $score);
    }

    public function nextQuestion() {
        $this->qP = new qcmParam();
        $this->page->addVar('current', $this->qP->jsonParam()['current']);        
    }

}