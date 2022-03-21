<?php


require '../includes/connection.php';


//зброс очков
if(false){
    for($i=0;$data[$i];$i++){
        if($data[$i]['points']=== ∞)$i++;
        if(in_array($data[$i][id],  $user_visits[count($user_visits)-1] [1])){
            $data[$i]['points']=1;
        }else{
            $data[$i]['points']=0;
        }
    }
file_put_contents('../database/users.json', json_encode($data));
}


  
$v = 0;
$i = 0;
while($randome[$v]){
    if ($randome[$v][1] == 0) {
        $today_randome[$i] = $randome[$v][0];
        $i++;
    }
    $v++;
}?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?=$url_to_site?>/src/favicon.ico">
	<link rel="stylesheet" href="<?=$url_to_site?>players/style.css?v=<?= filemtime('style.css')?>">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
	<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
	<title>Document</title>
</head>
<body>

    <?php
        
        $args = array(
            'last_visits_of_users' => 1,
            'sort'=>true,
        );
        
        $users = new data_displaying($args);
    ?>
    
    <header>
    	<div class="left_header">
            <h1 onclick="final_prize()"  id="test">Restart Points
            <!-- Очки Рестарта   -->
            
            <?php 
            
            
            ?>
            </h1>
            <div class="restart_counter_wrapper">
               <div class="restart_counter" id="today_counter"><?=$users->today_visits_count?></div>
            </div>
         </div>
    	<div class="right_header">
    	    <div onclick="team_separate()" class="team_btn">
    	        <div>H</div>
    	    </div>
            <div onclick="drop()" class="drop" id="randome_btn_drop"></div>
            <div onclick="myFunction()" class="randome_btn">
               <div class="randome_text">Выбрать из </div>
               <div class="randome_counter" id="randome_counter">
                <?= $users->today_randome_count?></div>
            </div>
         </div>
    </header>

    <section>
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                    
                    <?php
                        while ($users->is_data){
                            echo '<div id="my_swiper_cotainer"class="swiper-slide"><div id="user_grid" class="user_grid">';
                            
                            for ($i=1;$i<=12;$i++){
                                if($users->is_data){
                                    $users->load_user();
                                    echo '<div class="user_block" id='.$users->user_id.'>';
                                    if ($users->is_user_present){
                                        echo '<div class="present_user"></div>';
                                    }
                                    echo '<img class="user_foto" src="'.$users->user_photo.'" alt="">';
                		            echo '<div class="user_points">'. $users->user_points .'</div>';
                		            echo '<div class="info_block">';
                    		        echo '<div class="user_name">'.$users->user_name .'</div>';
                		            echo '</div></div>';
                                }
                            }
                            echo '</div></div>';
                        }
            		?>
            </div>
        
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        
        </div>
        <div id="imagin_start" class="imaginar_start hidded" onclick="startrandome()">start</div>
        <div id="imaginar_person" class="imaginar_person hidded">
            <div id="imag_img"class="imag_img"></div>
            <div class="imag_info_block">
                <div id="imag_user_name" class="imag_user_name">Имя Фамилия</div>
                <div id="imag_uesr_points" class="imag_uesr_points">очки = ?</div>
            </div>
            <div id="loading" class="loading"></div>
        </div>
        <div onclick="my_delete()" id="imaginar_block" class="imaginar_block_for_delete hidded"></div>
</section>
	
<section id="user_randome_selector_wrapper" class="user_randome_selector_wrapper hidded">
    <div onclick="delete_randome_selector()" class="user_randome_selector_delete"></div>
    <div class="user_randome_selector_box">
        <div onclick="randome_teams_ajax(2)">2</div>
        <div onclick="randome_teams_ajax(3)">3</div>
        <div onclick="randome_teams_ajax(4)">4</div>
        <div onclick="randome_teams_ajax(5)">5</div>
        <div onclick="randome_teams_ajax(6)">6</div>
        <div onclick="randome_teams_ajax(7)">7</div>
    </div>
</section>


<section id="user_randome_finish_selector_wrapper" class="user_randome_finish_selector_wrapper hidded">
    <div onclick="delete_randome_finish_selector()" class="user_randome_finish_selector_delete"></div>
</section>


<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        //spaceBetween: 30,
        //speed: 3000,
        
        
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        speed: 5000,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
  </script>


  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="<?=$url_to_site?>players/script.js"></script>
</body>
</html>