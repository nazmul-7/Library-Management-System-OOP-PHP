<?php


/**
*  Session Class
*/
class session {
	
	public static function start(){
		session_start();
	}
	public  function destroy(){
		session_destroy();
	}
	public static function set($key, $value){
		$_SESSION[$key]=$value; 
	}
	public static function checksession(){
		self::start();
		if(self::get("login") == false){
			self::destroy();
			header("Location: ".BASE_URL."/login");
		}
	}

	public static function get($key){

		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		} else {
			return false;
		}
		
	}
	public static function unset($msg){

		unset($_SESSION[$msg]);}
		

}

?>