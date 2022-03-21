<?php

require '../../includes/connection.php';

$teams_requests = $_POST["numb"];

$users = new randome();
$users->randome_team_shuffle($teams_requests);


