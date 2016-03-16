<?php
$URL = explode('/', $_SERVER['REQUEST_URI']);
switch($URL[1]){
    case '':
        include_once('pages/main.php');
        break;
    case 'services':
        include_once('pages/services.php');
        break;
    case 'contacts':
        include_once('pages/contacts.php');
        break;
    case 'threats':
        include_once('pages/threats.php');
        break;
}