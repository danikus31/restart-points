<?php

/*
if(!$_COOKIE["acces"]){
    echo'<h1>Acces Denied</h1>';
    die();
}
*/

require '../includes/connection.php';



/*
$v = 0;
$i = 0;
while($randome[$v]){
    if ($randome[$v][1] == 0) {
        $today_randome[$i] = $randome[$v][0];
        $i++;
    }
    $v++;
}
*/

function was_birthday($user_date){
    if(date("m",strtotime($user_date)) - date('m') == 0){
        $test_date = date("d",strtotime($user_date));
        if($test_date - date(d) <= 0 and $test_date - date(d)>-8){
            return 1;
        }
    }else if(date("m",strtotime($user_date)) - date('m') == -1){
        $test_date = date("d",strtotime($user_date)) + cal_days_in_month(CAL_GREGORIAN, date('m')-1, date('Y'));
        if($test_date - date(d) <= 0 and $test_date - date(d)>-8){
            return 1;
        }  
    }else{
        return 0;
    }
}




function is_birthday($user_date){
    if(date("m",strtotime($user_date)) - date('m') == 0){
        $test_date = date("d",strtotime($user_date));
        if($test_date - date(d) <8 and $test_date - date(d)>0){
            return 1;
        }
    }else if(date("m",strtotime($user_date)) - date('m') == 1){
        $test_date = date("d",strtotime($user_date)) + cal_days_in_month(CAL_GREGORIAN, date('m')-1, date('Y'));
        if($test_date - date(d) <8 and $test_date - date(d)>0){
            return 1;
        }  
    }else{
        return 0;
    }
}

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?=$url_to_site?>/src/favicon.ico">
    <link rel="stylesheet" href="<?=$url_to_site?>add_points/style.css?v=1.0.9">
    <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<?php
    $args = array();
    
    $users = new data_displaying($args);
?>
        
    <header>
        <div class="search_wrapper">
            <div onclick="display_controler()" class="remote_control_btn"></div>
            <div class="input_wrapper">
                <input id="myInput" placeholder="search" onfocus="this.placeholder = ''" onblur="this.placeholder = 'search'" >
                <div onclick="clearsearch()" style="display:none;" class="clear_search"></div>
            </div>
        </div>
    </header>
    <section id="controler" class="controler_sectoion hidden">
        <div id="controler_wrapper_id" class="controler_wrapper hidden">
            <div onclick="controler_close()" class="controler_close">
                <div class="controler_close_icon"></div>
                <div class="controler_close_text">ЗАКРЫТЬ</div>
            </div>
            <div onclick="controler_drop()" class="controler_drop">
                <div class="controler_drop_icon"></div>
                <div class="controler_drop_text">СБРОС</div>
            </div>
            <div onclick="controler_chose()" class="controler_chose" id="controler_chose">
                <div class="controler_randome_text">ВЫБРАТЬ ИЗ</div>
                <div class="controler_randome_counter" id="controler_counter"><?php // count($today_randome)?></div>
            </div>
            <div onclick="controler_close_chose()" class="controler_close_chose none" id="controler_close_chose">
                <div class="controler_close_chose_text">скрыть Окно проектора</div>
            </div>
        </div>
    </section>
    <section class="birthday_wrapper">

        <div class="all_users_info">        
            <div id="now_is_date" class="now_is_date"><?php echo date("Y-n-j");?></div>
            <div class="now_is_online"><div>ONLINE:</div><p id="online_counter"><?=$users->today_visits_count?></p></div>
        </div>
    <br>
        <div class="birthday_header">
            <h3>Был день рождения</h3>
        </div>
        <div class="birthday_users_wrapper">
        <?php
        /*
        for ($x = 0; $data[$x];$x++) {
            if($data[$x]['birth']){
                if( was_birthday($data[$x]['birth']) ){
                    echo $data[$x]['id']. " ";
                    echo $data[$x]['name']." ".$data[$x]['surname'];
                    echo "</br>";
                }
            }
        }
        */
        ?>
        </div>

<br>


        <div class="birthday_header">
            <h3>Будет день рождения</h3>
        </div>
        <div class="birthday_users_wrapper">
        <?php
        /*
        for ($x = 0; $data[$x]; $x++) {
            if($data[$x]['birth']){
                if( is_birthday($data[$x]['birth']) ){
                    echo $data[$x]['id']. " ";
                    echo $data[$x]['name']." ".$data[$x]['surname'];
                    echo "</br>";
                }
            }
        }
        */
        ?>
        </div>
    </section>
    <section id="users">
        <?php

        while ($users->is_data){
            $users->load_user()
        ?>
            
            <div class="user_block" id="<?=$users->user_id?>">
                <div class="user_stats">
                    <img class="user_foto" src="<?=$users->user_photo?>" alt="">
                        <div class="info_block" onclick="showinterface(<?=$users->user_id?>)">
                        <div id="user_name" class="user_name">
                            <?=$users->user_id?>.
                            <?=$users->user_name?> <?=$users->user_surname?>
                                <?php if($users->is_set_birthday){echo' ('.$users->user_age.')';}?>
                        </div>
                    
                        <div class="users_pointers_block">
                            <div class="user_points">очки = </div>
                            <div id="personid<?=$users->user_id?>"><?=$users->user_points?></div>
                            <div><?=$users->user_last_visit?></div>
                        </div>
                    </div>
                        
                    <div onclick="add_point(<?=$users->user_id?>)" id="personadd<?=$users->user_id?>" class="points_block add_point <?php if($users->is_user_present){echo 'used';}?>"></div>
                </div>
                    
                
                <div class="user_info none">
                    <form class="birth_form">
                        <input id="personday<?=$users->user_id?>" class="input_date input_day" value="<?=$users->user_birth_d?>" placeholder="01">
                        <input id="personmonth<?=$users->user_id?>" class="input_date input_month" value="<?=$users->user_birth_m?>" placeholder="12">
                        <input id="personyear<?=$users->user_id?>" class="input_date input_year" value="<?=$users->user_birth_y?>" placeholder="2000">
                        <div class="date_button" onclick="add_birth_day(<?=$users->user_id?>)">submit</div>
                    </form>
                            
                    <div onclick="undo_point(<?=$users->user_id?>)" id="personminus<?=$users->user_id?>" class="points_block minus_point <?php if(!$users->is_user_present){echo 'used';}?>"></div>
                </div>
            </div>
          <?php }?>
    </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="<?=$url_to_site?>add_points/script.js?v=1.0.8"></script>
</body>
</html>