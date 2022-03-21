<?php



require '../../includes/connection.php';

$projector = new projector();

$projector->change_stat($_POST['stat']);

$answer['count'] = 'X';


echo json_encode($answer);

