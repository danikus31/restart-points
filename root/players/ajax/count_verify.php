<?php 

require '../../includes/connection.php';


$users = new data_displaying($args);
$answer['count'] = $users->today_visits_count ;


$projector = new projector();
$answer['stat'] = $projector->init_projector;



echo json_encode($answer);