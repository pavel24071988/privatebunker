<?php

function get_sitemetatags($URI, $db){
    $meta_title = 'Ваше защитное сооружение. Бункеры по всей России.';
    $meta_keywords = 'бункер, установка бункера, защитное сооружение, системы безопасности, вентеляция';
    $meta_description = 'Мы проектируем и возводим часные защитные сооружения любого уровня сложности. Каждый проект включает самые современные технологии автономного жизнеобеспечения и сопровождвется дальнейшим обслуживанием.';
    if($URI[1] === 'about-us') $URI[1] = 'about_us';
    if(!empty($URI[1]) && !empty($URI[2])){
        try{
            $meta = $db->query('SELECT * FROM '. $URI[1] .' WHERE url = \''. $URI[2] .'\'')->fetch();
            $meta_title = isset($meta['meta_title']) ? $meta['meta_title'] : $meta_title;
            $meta_keywords = isset($meta['meta_keywords']) ? $meta['meta_keywords'] : $meta_keywords;
            $meta_description = isset($meta['meta_description']) ? $meta['meta_description'] : $meta_description;
        }catch(Exception $e){
        }
    }elseif(empty($URI[2]) && !empty($URI[1])){
        try{
            $meta = $db->query('SELECT * FROM main_meta WHERE name = \''. $URI[1] .'\'')->fetch();
            $meta_title = isset($meta['meta_title']) ? $meta['meta_title'] : $meta_title;
            $meta_keywords = isset($meta['meta_keywords']) ? $meta['meta_keywords'] : $meta_keywords;
            $meta_description = isset($meta['meta_description']) ? $meta['meta_description'] : $meta_description;
        }catch(Exception $e){
        }
    }
    
    echo('
      <title>'. $meta_title .'</title>
      <meta name="keywords" content="'. $meta_keywords .'">
      <meta name="description" content="'. $meta_description .'">
    ');
}

function get_article_section($URL){
    $section_name = 'Основная информация';
    $array_of_names = array(
        'about-us' => 'О нас',
        'types' => 'Виды работ',
        'gallery' => 'Галерея',
        'sales' => 'Скидки',
        'price' => 'Цены',
        'feedback' => 'Контакты',
        'tips' => 'Полезные советы'
    );
    if(!empty($array_of_names[$URL])) $section_name = $array_of_names[$URL];
    return $section_name;
}