<?php 
    function autoload($class) {

        // $classes = '../'.str_replace('\\', '/', $class).'.php'.'<br>';
        // echo $classes;

        // require '../'.str_replace('\\', '/', $class).'.class.php';
        // if(strcmp($class, 'Library\Models\NewsManagers_PDO') !== 0) {
        //     $classes = '../'.str_replace('\\', '/', $class).'.php'.'<br>';
        //     echo $classes;
        //     require '../'.str_replace('\\', '/', $class).'.php';
        // }

        require '../'.str_replace('\\', '/', $class).'.php';

    } 

    spl_autoload_register('autoload');
?>