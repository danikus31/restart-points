<?php

require '../../includes/connection.php';


$id = $_POST['id'];
$birth = $_POST['birth'];


$user = new R_user($id);


$user->update_birthday($birth);

echo 'recived'.$birth.'id='.$id."\n";
echo 'base= '.$user->user_date. 'id='. $user->user_id;