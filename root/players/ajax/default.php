<?php

require '../../includes/connection.php';

$users = new randome();
$users->reset_today_randome();

$users->projector = 0;
$users->data_save_projector();

echo $users->today_randome_count;




?>