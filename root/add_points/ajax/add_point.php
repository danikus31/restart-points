<?php

require '../../includes/connection.php';


$user = new R_user((int)$_POST['id']);

$user->today_add_point();

$response['points'] = $user->user_points;

$response['online_counter'] = $user->today_visits_count;

//отправка инфы
echo json_encode($response);

