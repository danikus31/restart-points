<?php

$site_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';




$url_to_site = $site_url."/root/";
$url_to_sub_base = $_SERVER['DOCUMENT_ROOT']."/database/";
$url_to_sub_base_for_photo = $site_url."/database/";	


$url_to_base = $url_to_sub_base."tables/";
$url_to_photo = $url_to_sub_base_for_photo."photos/";


$data = json_decode(file_get_contents($url_to_base."users.json"), true);

$user_visits = json_decode(file_get_contents($url_to_base."visit.json"), true);

$randome = json_decode(file_get_contents($url_to_base."randome.json"), true);

$projector = json_decode(file_get_contents($url_to_base."projecto.json"), true);

