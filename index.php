<?php 

	define('BASE_URL', 'http://localhost/library');
	include_once "config/config.php";
	include_once "config/database.php";
	include_once "config/load.php";
	include_once "config/session.php";
	
	
	$url=isset($_GET["url"])? $_GET["url"]: NULL;
	if($url != NULL){
		$url = rtrim($url, '/');
		$url = explode('/', $url);
	}

	else{ 
		unset($url); 
	}

	if(isset($url[0])){
		include_once "controllers/".$url[0].".php";
		$main = new $url[0]();
		if(isset($url[1])){
			if (isset($url[2])) {
				echo $main->{$url[1]}($url[2]);
			}		
			elseif (isset($url[1] )) {
				echo $main->{$url[1]}();
			}
		}
	}
	else {
		include_once "controllers/index.php";
		$auto = new index();
		$auto->home();
	}

	
?>




