<?php


require '../../includes/connection.php';

$chids_in_randome =  array(
    "26",
    "17",
    "8"

);



$randome_user_var = random_int(0, count($chids_in_randome));

$randome_user_var = $chids_in_randome[$randome_user_var];

foreach ($data as $key => $value) {
    if ($value['id'] ==  $randome_user_var) {
        $randome_user[name] = $data[$key]['name'] .' '. $data[$key]['surname'];
        $randome_user[points] = 'очки = '. $data[$key]['points'];
        $randome_user[img] = 'url("../src/foto/'. $data[$key]['id'] .'.jpg")';
        
        $randome_user[now_in_randome] = count($today_randome) - 1;
    }
}





$randome_user = json_encode($randome_user);

echo $randome_user;