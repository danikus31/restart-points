<?php

require '../../includes/connection.php';


$users = new randome();
$users->get_today_tracking_randome_one();


$users->projector = 0;
$users->data_save_projector();


$randome_user['name'] = $users->user_name.' '.mb_substr($users->user_surname,0,1).'.';
$randome_user['points'] = $users->user_points;
$randome_user['img'] = $users->user_photo;
$randome_user['now_in_randome'] = $users->today_randome_count;

echo json_encode($randome_user);

