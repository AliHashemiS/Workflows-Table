<?php
	// Database params
    define('DB_HOST', getenv('DB_HOST'));
    define('DB_USER', getenv('DB_USER'));
    define('DB_PASS', getenv('DB_PASS'));
    define('DB_PORT', getenv('DB_PORT'));
    define('DB_NAME', getenv('DB_NAME'));
	
	// APP ROOT
	define('APP_ROOT', dirname(dirname(__FILE__)));
	
	// URL ROOT
    if(strpos($_SERVER['HTTP_HOST'], "localhost") !== false || strpos($_SERVER['HTTP_HOST'], "127.0.0.1") !== false){
        define('URL_ROOT', "http://" . $_SERVER['HTTP_HOST'] . str_replace("public/index.php", "", $_SERVER['SCRIPT_NAME']));
    } else {
        define('URL_ROOT', "https://".$_SERVER['HTTP_HOST'].str_replace("public/index.php", "", $_SERVER['SCRIPT_NAME']));
    }

	// site name
	define('SITE_NAME', str_replace("/public/index.php", "", $_SERVER['SCRIPT_NAME']));

	//Meta
    define('CARD_DESCRIPTION', '=WebsiteDescription=');
    define('CARD_IMAGE', '=WebsiteIMG=');
