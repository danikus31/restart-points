<?php

require '../includes/connection.php';
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?=$url_to_site?>/src/favicon.ico">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="wrapper">
            <input placeholder="Начни вводить имя...">
            <div class="filtre_wrapper">
                <div onclick="openfiltre()" class="visible_filtre_block">
                    <div class="visible_filtre_text">Сортировка</div>
                    <div class="visible_filtre_icon"></div>
                </div>
                <div id="fitlre_pop_up" class="fitlre_pop_up dis_pop_up"><!-- fitlre_pop_up-->
                    <a href="" id="user_name" class="filtre_type">по имени</a>
                    <hr>
                    <a href="" id="" class="filtre_type">по возрасту</a>
                    <hr>
                    <a href="" id="user_points" class="filtre_type">по баллам</a>
                    <hr>
                    <a href="" id="" class="filtre_type">по id</a>
                </div>
            </div>
        </div>
    </header>
    <section class="wrapper section_separate"></section>
    <section>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php 
                $v=0;
                while ( $user_visits[$v] ){?>


                <div class="swiper-slide">
                    <div class="wrapper">
                        <div class="swiper_date_wrapper">
                            <div class="swiper_date_text"><?=date("Y F d",strtotime($user_visits[$v][0])) ?></div>
                            <div class="swiper_date_line"></div>
                            <div class="swiper_date_presents"><?=count($user_visits[$v][1])?></div>
                        </div>
                    </div>
                    <div class="all_users">
                        <?php    
                        $i=0;
                        while ($user_visits[$v][1][$i]){
                        
                        echo '<div class="user">';
                        
                        
                        foreach ($data as $key => $value) {
                            if ($value['id'] == $user_visits[$v][1][$i]) {
                                echo '<img class="user_foto" src="../src/foto/'. $user_visits[$v][1][$i] .'.jpg" alt="">';
                                echo '<div class="info_block">';
                                echo '<div class="user_name">'. $value['name'].' '. $value['surname'] .'('. $user_visits[$v][1][$i] .')</div>';
                                echo '<div class="user_points">очки= '. $value['points'] .'</div>';
                                echo '</div>';
                            }
                        }
                        echo '</div>';
                        $i++;                  
                    }
                    $v++;
                    echo '</div></div>';
                }
            ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
      pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      initialSlide: '999'
    });
  </script>
</body>
</html>