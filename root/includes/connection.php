<?php
date_default_timezone_set('Europe/Bucharest');

$site_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

$url_to_site = $site_url . "root/";

require'variables.php';

require'parent_class.php';

require'R_user.php';

require'data_displaying.php';

require'data_randome.php';

require'data_projector.php';