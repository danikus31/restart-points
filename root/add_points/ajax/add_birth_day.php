<?php

require '../includes/connection.php';


$id = $_POST['id'];
$birth = $_POST['birth'];




//$data[$id-1]['birth'] = $birth;


file_put_contents('../database/users.json', json_encode($data));

echo $birth;