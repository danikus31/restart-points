<?php
require '../includes/connection.php';


file_put_contents('../../database/users.json', json_encode($data));

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="<?=$url_to_site?>/src/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../root/add_new/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
	<title>Document</title>
</head>
<body>
    
    <header>
    	<input id="input_name" placeholder="Имя">
    	<input id="input_surname" placeholder="Фамилия">
    	
    	
    	
    	
    	<!--
        <div class='preview'>
                <img src="upload/default.png" id="img" width="100" height="100">
            </div>
            <div >
                <input type="file" id="file" name="file" />
                <input type="button" class="button" value="Upload" id="but_upload">
            </div>
        -->
        
            
    	<div onclick="add_point()" id="1"  class="add_point">add</div>
    </header>
    

<script type="text/javascript" src="../../root/add_new/script.js"></script>
</body>
</html>