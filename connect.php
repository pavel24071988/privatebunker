<?php
try {
    //$db = new PDO("mysql:host=localhost;dbname=u0133874_privatebunker", "root", "12345");
    //$db = new PDO("mysql:host=localhost;dbname=u0133874_privatebunker", "u0133874_user", "privatebunker2016");
    $db = new PDO("mysql:host=localhost;dbname=u0133874_privatebunker", u0133874_user, privatebunker2016);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("set names utf8");
}catch(Exception $e){
    echo('Проблема коннекта к БД');
    exit;
}
$URI = explode('/', $_SERVER['REQUEST_URI']);