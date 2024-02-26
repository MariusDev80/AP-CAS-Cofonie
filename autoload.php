<?php 
session_start();
    function my_autoloader($class) 
    {
        $result = substr($class,0,5);
        if (strcmp($result,"contr") == 0)
            include_once 'controler/'.$class. '.php';
        else 
            if (strcmp($result, "acces") == 0)
                include_once 'tool/'.$class. '.php';
            else 
                if (strcmp($result,'conte') == 0)
                    include_once 'proccessing/classeConteneur/'.$class. '.php';
                else
                    if (strcmp($result,'metie') == 0)
                        include_once 'proccessing/classeMetier/'.$class. '.php';
                    else
                        if (strcmp($result, 'vueCe') == 0)
                            include_once 'view/ihm/'.$class. '.php';
    }
    spl_autoload_register('my_autoloader');
?>