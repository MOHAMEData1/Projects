<?php

session_start();
 return [
     'template' => [
         'top' => TEMPLATE_PATH . 'top.php',
         'nav' => TEMPLATE_PATH . 'nav.php',
         ':view' => ':action_view',
         'footercontent' => TEMPLATE_PATH.'footercontent.php'
     ],
     'head_resource' => [
         'css' => [
             'bootstrap' => CSS . 'bootstrap.rtl.css',
             'fawsome' => CSS . 'font-awesome.min.css',
             'animate' => CSS . 'animate.css',
             'hover' => CSS . 'hover-min.css',
             'main' => CSS . 'main.css'
         ]
     ],
     'footer_resource' => [
         'js' => [
             'jquery' => JS. 'jquery-1.9.1.js',
             'bootstrap' => JS. 'bootstrap.min.rtl.js',
             'jquery_nice' => JS . 'jquery.nicescroll.min.js',
             'wow' => JS . 'wow.min.js',
             'main' => JS.'main.js'
         ]
     ]

 ];

