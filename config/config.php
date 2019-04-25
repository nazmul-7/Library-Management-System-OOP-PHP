<?php

/**
*  main model
*/

class config{

	protected $db = array();
	protected $FB = array();
	protected $helper = array();
	protected $load = array();
	
	public function __construct(){
		$dsn = 'mysql:dbname=db_stack; host=localhost';
		$user = 'root';
		$pass = '';
		$this->db= new database($dsn, $user, $pass);

		$this->FB = new \Facebook\Facebook([
			'app_id' => '1462930533000000',
			'app_secret' => '9b87ceb8cbd98e67a06bd28251000000',
			'default_graph_version' => 'v2.10'
		]);
		$this->helper = $this->FB->getRedirectLoginHelper();
		$this->load = new load();
	}
}

?>