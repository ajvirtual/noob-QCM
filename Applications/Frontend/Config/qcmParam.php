<?php
namespace Applications\Frontend\Config;

use Exception;

class qcmParam {

    // public function __construct() {
    // }

    public $tab = [
        [
            'form' => [
                'value' => ['blanc', 'rouge', 'bleu ciel', 'vert', 'jaune', 'violet', 'noir'],
                'id_prefix' => 'id2',
                'submit' => 'submit'
            ],
            'rep' => ['jaune', 'bleu ciel', 'noir'],
            'query' => 'quelles sont mes couleurs preferes'
        ],

        [
            'form' => [
                'value' => ['blanc', 'bleu ciel', 'jaune', 'violet', 'noir'],
                'id_prefix' => 'id2',
                'submit' => 'submit'
            ],
            'rep' => ['jaune'],
            'query' => 'couleur prefere'
        ],
        [
            'form' => [
                'value' => ['blanc', 'jaune', 'violet', 'noir'],
                'id_prefix' => 'id2',
                'submit' => 'submit'
            ],
            'rep' => ['jaune'],
            'query' => 'prefere'
        ],
        [
            'form' => [
                'value' => ['blanc', 'bleu ciel', 'jaune', 'violet', 'noir', 'rouge'],
                'id_prefix' => 'id2',
                'submit' => 'submit'
            ],
            'rep' => ['jaune'],
            'query' => '  couleur '
        ],

        // [
        //     'form' => [
        //         'value' => ['blanc', 'rouge', 'bleu ciel', 'vert', 'jaune', 'violet', 'noir'],
        //         'id_prefix' => 'id2',
        //         'submit' => 'submit'
        //     ],
        //     'rep' => ['jaune', 'bleu ciel', 'noir'],
        //     'query' => 'quelles sont mes couleurs preferes'
        // ]
        
    ];

    public static function initParamQcm() {
        // $_SESSION['score'] = 4;
        $param = json_encode(['score' => 0, 'current' => 0]);
        $fileParam = fopen('currentParam.json', 'w');
        fwrite($fileParam, $param);
        fclose($fileParam);
    }

    Public function incrementeScore($incrementScore = 1, $incrementCurrent = 1) {
    //  self::$score = $_SESSION['score']++;
    //    self::$score++;

        if(\file_exists('currentParam.json')) {
            $fileRead = fopen('currentParam.json', 'r');
            while(!feof($fileRead)) {
               $content = fread($fileRead, 1024);
            }
            fclose($fileRead);
        } else {
            throw new Exception('curretParam.json n\'existe pas');
            return;
        }

        $oldParam = isset($content) ? (array) json_decode($content) : [];

        $param = \json_encode(['score' => $oldParam['score']+$incrementScore, 'current' => $oldParam['current']+$incrementCurrent]);

        $fileWrite = fopen('currentParam.json', 'w');
        fwrite($fileWrite, $param, 1024);
        fclose($fileWrite);
        return;
    }

    public function jsonParam() {
        if(\file_exists('currentParam.json')) {
            $param = (array) json_decode(file_get_contents('currentParam.json'));
        } else {
            throw new Exception('curretParam.json n\'existe pas');
        }
        return $param;
    }
}