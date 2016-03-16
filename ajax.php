<?php

$URI = explode('/', $_SERVER['REQUEST_URI']);

switch ($URI[2]){
    case 'callback':
        if(!empty($_POST['phone']))
            callback($_POST['phone']);
    break;
    case 'contacts':
        if(!empty($_POST['data']))
            contacts($_POST['data']);
    break;
}

function callback($phone_number){

    $to = 'alexanderpconstant@gmail.com, kirillpconstant@gmail.com, pavel24071988@mail.ru';
    $subject = "Отработала форма заказа обратного звонка pconstant.ru";
    $message = 'Нужно перезвонить по телефону "'. $_POST['phone'] .'" - заявка от черта: "'. $_POST['name'] .'" -> так как у человека какой-то неведомый вопрос, совет, проблема. Это тревожный знак и это очень серьезно.<br/>
    Ребята - давайте соберемся и поработаем на славу. Что бы человек купил у нас этот чёртов потолок. За дело!<br/>';

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: pconstant.ru <mail@pconstant.ru>\r\n";
    $headers .= "Cc: mail@pconstant.ru\r\n";
    $headers .= "Bcc: mail@pconstant.ru\r\n";

    if(mail($to, $subject, $message, $headers)){
        echo(json_encode(array('response' => 'ok')));
    }else{
        echo(json_encode(array('response' => 'error')));
    }
}

function contacts($data){
    $formArray = array();
    parse_str($data, $formArray);

    if(empty($formArray['name']) || empty($formArray['email']) || empty($formArray['message'])){
        echo(json_encode(array('code' => 0, 'response' => 'Заполните обязательные поля.')));
        exit;
    }

    $to = 'pavel24071988@mail.ru, office@privatebunker.ru';
    $subject = 'Отработала форма контакты сайта privatebunker.ru';
    $message = '
        <strong>Реквизиты:</strong><br/>
        <strong>Имя:</strong> '. $formArray['name'] .'<br/>
        <strong>E-mail:</strong> '. $formArray['email'] .'<br/>
        <strong>Телефон:</strong> '. $formArray['phone'] .'<br/>
        <strong>Текст заявки:</strong> '. $formArray['message'] .'<br/><br/><br/>
        <strong>Ободряющий текст:</strong>
        Заявка от черта: "'. $formArray['name'] .'" -> так как у человека какой-то неведомый вопрос, совет, проблема. Это тревожный знак и это очень серьезно.<br/>
        Ребята - давайте соберемся и поработаем на славу. Что бы человек купил у нас этот чёртов бункер. За дело!<br/>
    ';
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: privatebunker.ru <office@privatebunker.ru>\r\n";
    $headers .= "Cc: office@privatebunker.ru\r\n";
    $headers .= "Bcc: office@privatebunker.ru\r\n";

    if(mail($to, $subject, $message, $headers)) echo(json_encode(array('code' => 1, 'response' => 'Сообщение отправлено. Мы свяжемся с Вами в ближайшее время.')));
    else echo(json_encode(array('code' => 0, 'response' => 'Произошла ошибка отправки. Попробуйте позже.')));
}