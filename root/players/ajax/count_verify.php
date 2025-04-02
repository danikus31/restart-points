<?php 

require '../../includes/connection.php';


$users = new data_displaying('nothing');
$answer['count'] = $users->today_visits_count ;


$answer['stat'] = $users->projector;



echo json_encode($answer);