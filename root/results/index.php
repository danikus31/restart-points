<?php


$data = json_decode(file_get_contents("../database/z_users.json"), true);

$user_visits = json_decode(file_get_contents("../database/z_visit.json"), true);

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
	<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
	<title>Document</title>
</head>
<body>
    <section class="wrapper">
        <div>name</div>
        <div>19-12</div>
        <div>26-12</div>
        <div>09-01</div>
        <div>16-01</div>
        <div>23-01</div>
        <div>30-01</div>
        <div>06-02</div>
        <div>13-02</div>
        <div>20-02</div>
        <div>27-02</div>
        <div>06-03</div>
        <div>13-03</div>
        <div>20-03</div>
        <div>27-03</div>
        
        <?php
            $i = 0;
            while($data[$i]){
                echo"<div>". $data[$i]['id']. '.' . $data[$i]['name'].' '.$data[$i]['surname'] . '</div>';
            
                $v = 0;
                $m = 0;
                    while($user_visits[$v]){
                        if (in_array($data[$i]['id'], $user_visits[$v][1])) {
                            echo"<div class='green'>✓</div>";
                        }else{
                            echo"<div class='red'></div>";
                        }
                    $v++;
                    }
                    
                $i++;
                }
        
        
        ?>
    </section>

</body>
</html>