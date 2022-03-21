<?php

require '../../includes/connection.php';

$users = new randome();
$users->reset_today_randome();

echo $users->today_randome_count;




?>