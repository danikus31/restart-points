<?php

require '../includes/connection.php';


$New_users_name = $_POST['name'];//ответ пользователя

$New_users_surname = $_POST['surname'];

$New_users = new R_user();

$New_users->add_new_user($New_users_name, $New_users_surname);














