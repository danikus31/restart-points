<?php

require '../includes/connection.php';


$New_users_name = $_POST['name'];//ответ пользователя

$New_users_surname = $_POST['surname'];


//found free id
for($i=0;$data[$i]; $i++){
    $free_id = $i;
}
$free_id++;



$data[$free_id]['name'] = $New_users_name;

$data[$free_id]['surname'] = $New_users_surname;

$data[$free_id]['id'] = $free_id;

$data[$free_id]['points'] = 1;

$data[$free_id]['date'] = date('d-m-Y');


// encode array to json and save to file
file_put_contents($url_to_base.'users.json', json_encode($data));


$user_visits[count($user_visits)-1] ['list'] [count($user_visits[count($user_visits)-1]['list'])] = strval($free_id);






// encode array to json and save to file
file_put_contents($url_to_base.'visit.json', json_encode($user_visits));



$randome[1][count($randome[1])]['0'] = count($data);
    
$randome[1][count($randome[1])-1]['1'] = 0;


file_put_contents($url_to_base.'randome.json', json_encode($randome));















