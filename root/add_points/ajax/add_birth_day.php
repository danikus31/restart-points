<?php

require '../../includes/connection.php';


$id = $_POST['id'];
$birth = $_POST['birth'];


$user = new R_user($_POST['id']);


$user->update_birthday($birth);

echo $birth;