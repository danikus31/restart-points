<?php



require '../../includes/connection.php';

$projector = new database_connection();

$projector->projector =$_POST['stat'];
$projector->data_save_projector();

$answer['count'] = 'X';
$answer['status'] = $projector->projector;


echo json_encode($answer);

