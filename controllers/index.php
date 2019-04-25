<?php
class index extends config{

	function __construct(){

		parent::__construct();
	}

    public function home(){
		$this->load->partial("header");
		$this->load->view("home");
		$this->load->partial("footer");
	}

	public function signIn(){

		$redirectURL = BASE_URL.'/usersController/fbLogin';
		$permissions = ['email'];
		$loginURL = $this->helper->getLoginUrl($redirectURL, $permissions);
		$this->load->partial("header");
		$this->load->view("signin");
		$this->load->partial("footer");
	}
	
	public function signUp(){
		$this->load->partial("header");
		$this->load->view("signup");
		$this->load->partial("footer");
	}
	public function blank(){
		$this->load->partial("header");
		$this->load->view("blank");
		$this->load->partial("footer");
	}
}