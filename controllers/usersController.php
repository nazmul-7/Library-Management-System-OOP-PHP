<?php
class usersController extends config

{
	function __construct()
	{
		parent::__construct();
	}
	public function userRegistration()

	{
		$firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : NULL;
		$lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : NULL;
		$userName = isset($_POST["userName"]) ? $_POST["userName"] : NULL;
		$email = isset($_POST["email"]) ? $_POST["email"] : NULL;
		$password = isset($_POST["password"]) ? $_POST["password"] : NULL;
		$cpassword = isset($_POST["confirmPassword"]) ? $_POST["confirmPassword"] : NULL;
		$min = 3;
		$max = 50;
		$error = [];
		$table = "users";
		if (strlen($firstName) < $min) {
			$error['firstName'] = "The Minimun character For First Name should be {$min}!!";
		}
		if (strlen($firstName) > $max) {
			$error['firstName'] = "The Maximum character For First Name  should be {$max}!!";
		}
		if (strlen($lastName) < $min) {
			$error['lastName'] = "The Minimun character For Last Name should be {$min}!!";
		}
		if (strlen($lastName) > $max) {
			$error['lastName'] = "The Maximum character For Last Name  should be {$max}!!";
		}
		if (strlen($email) < $min) {
			$error['email'] = "The Minimun character For Email should be {$min}!!";
		}
		if (strlen($email) > $max) {
			$error['email'] = "The Maximum character For Email  should be {$max}!!";
		}
		$condition = "email='$email' ";
		if ($this->db->getuserdata($table, $condition)) {
			$error['email'] = "This Email is already in our Database!!";
		}
		if (strlen($userName) < $min) {
			$error['userName'] = "The Minimun character For User Name should be {$min}!!";
		}
		if (strlen($userName) > $max) {
			$error['userName'] = "The Maximum character For User Name   should be {$max}!!";
		}
		$condition = "userName='$userName' ";
		if ($this->db->getuserdata($table, $condition)) {
			$error['userName'] = "User Name is alreay taken!!";
		}
		if (strlen($password) < $min) {
			$error['password'] = "The Minimun character For Password should be {$min}!!";
		}
		if (strlen($password) > $max) {
			$error['password'] = "The Maximum character For Password  should be {$max}!!";
		}
		if ($password !== $cpassword) {
			$error['password'] = "Password doesn't match!!";
		}
		if (empty($error)) {
			$hash = $this->sendVerificationEmail($firstName, $email);
			$data = array(
				'firstName' => $firstName,
				'lastName' => $lastName,
				'userName' => $userName,
				'email' => $email,
				'password' => $password,
				'varificationCode' => $hash,
			);
			$result = $this->db->userInsert($table, $data);
			session::start();
			if ($result == 1) {
				$mdata['msg'] = "Your regtration Successful!<br/>We have sent you a varification link to your email.Please confirm your ";
				session::set("msg", $mdata['msg']);
				$this->userLogin(1, $data);
				return;
			}
			else {
				$mdata['msg'] = "There was a error";
			}
			session::set("msg", $mdata['msg']);
			//header("Location: " . BASE_URL . "/index/signIn");
		}
		else {
			session::start();
			session::set("error", $error);
			print_r($error);
			header("Location: " . BASE_URL . "/index/signUp");
		}
	}
	public function userLogin($flag = 0, $sentData=[])

	{
		$error = [];
		$data = [];
		$table = "users";
		$userName = NULL;
		$password = NULL;
		$remember = false;
		if ($flag) {
			echo "I am from registration";
			$userName = $sentData['userName'];
			$password = $sentData['password'];
		}
		else {
			$userName = isset($_POST["userName"]) ? $_POST["userName"] : NULL;
			$password = isset($_POST["password"]) ? $_POST["password"] : NULL;
			$remember = isset($_POST["remember"]) ? $_POST["remember"] : NULL;
		}
		$data['userName'] = $userName;
		$data['password'] = $password;
		$data['remember'] = $remember;
		// $password = md5($password);
		$condition = "( userName ='$userName' OR email = '$userName')";
		$count = $this->db->usercontroll($table, $condition);
		if ($count > 0) {
			$condition = "( userName ='$userName' OR email = '$userName') and password='$password'";
			$count = $this->db->usercontroll($table, $condition);
			if ($count > 0) {
				$dbData = $this->db->getuserData($table, $condition);
				if ($remember) {
					setcookie("login", true, time() + 84600);
					setcookie("userName", $userName, time() + 84600);
					setcookie("id", $dbData[0]["id"], time() + 84600);
					setcookie("status", $dbData[0]["status"], time() + 84600);
				}
				session::start();
				session::set('dbData', $dbData);
				session::set("login", true);
				session::set("userName", $dbData[0]["userName"]);
				session::set("firstName", $dbData[0]["firstName"]);
				session::set("id", $dbData[0]["id"]);
				session::set("status", $dbData[0]["status"]);
				session::set("userType", $dbData[0]["userType"]);
				if($dbData[0]["status"]){
					header("Location: " . BASE_URL . "/index/home");
				}
				else{
					header("Location: " . BASE_URL . "/index/blank");
				}
				
			}
			else {
				session::start();
				$error['password'] = "Password  doesn't Match";
				session::set("error", $error);
				session::set("data", $data);
				header("Location: " . BASE_URL . "/index/signIn");
			}
		}
		else {
			session::start();
			$error['userName'] = "Username or Email doesn't Exist";
			session::set("error", $error);
			session::set("data", $data);
			header("Location: " . BASE_URL . "/index/signIn");
		}
	}
	public function sendVerificationEmail($name, $email){
		global $mailer;
		$hash = md5(random_int(pow(10, 5 - 1) , pow(10, 5) - 1));
		$link = BASE_URL . "/UserController/checkVerificationEmail?email=" . $email . "&hash=" . $hash;
		$message = (new Swift_Message('Verification link'))->setFrom(['noReply@admin.com' => 'Admin'])->setTo(["$email" => "$name"])->setBody("<h1>Here is your verification link. click here:</h1><br /><a href=" . $link . ">" . $link . "</a>", 'text/html');
		$result = $mailer->send($message);
		// var_dump($result);
		return $hash;
	}
	public function checkVerificationEmail(){
		$email = isset($_GET['email']) ? $_GET['email'] : NULL;
		$hash = isset($_GET['hash']) ? $_GET['hash'] : NULL;
		$error = [];
		$mdata = [];
		$table = "users";
		$condition = "email='$email' AND varificationCode='$hash'";
		if (!$this->db->getuserData($table, $condition)) {
			$error[] = 'Your are not a registered user.';
		}
		if (empty($error)) {
			$data = array(
				'status' => '1'
			);
			$result = $this->db->update($table, $data, $condition);
			if ($result == 1) {
				$mdata['msg'] = 'Your account is activated. Now you can login.';
				$_SESSION['mdata'] = $mdata;
				header("Location: " . BASE_URL . "/index/signIn");
			}
			else {
				$mdata['msg'] = 'Your account is not actived. Check your email inbox again.';
				$_SESSION['mdata'] = $mdata;
				header("Location: " . BASE_URL . "/index/signIn");
			}
		}
		else {
			$_SESSION['error'] = $error;
			// print_r($error);
			header('Location: ' . BASE_URL . '/IndexController/signup');
		}
	}
	public function userLogout(){
		session::start();
		session::destroy();
		if (isset($_COOKIE['login'])) {
			unset($_COOKIE['login']);
			unset($_COOKIE['username']);
			unset($_COOKIE['userid']);
			unset($_COOKIE['status']);
			unset($_COOKIE['userType']);
			setcookie("login", true, time() - 84600);
			setcookie("username", $username, time() - 84600);
			setcookie("userid", $data[0]["userid"], time() - 84600);
			setcookie("status", $data[0]["status"], time() - 84600);
			setcookie("userType", $data[0]["userType"], time() - 84600);
		}
		header("Location: " . BASE_URL . "/index/signIn");
	}
	public function fbLogin(){
		$data = [];
		$table = "users";
		try {
			$accessToken = $this->helper->getAccessToken();
		}
		catch(FacebookExceptionsFacebookResponseException $e) {
			echo "Response Exception: " . $e->getMessage();
			exit();
		}
		catch(FacebookExceptionsFacebookSDKException $e) {
			echo "SDK Exception: " . $e->getMessage();
			exit();
		}
		if (!$accessToken) {
			header('Location: login.php');
			exit();
		}
		$oAuth2Client = $this->FB->getOAuth2Client();
		if (!$accessToken->isLongLived()) {
			$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
		}
		$response = $this->FB->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
		$userData = $response->getGraphNode()->asArray();
		$fbEmail = $userData['email'];
		$condition = "( email = '$fbEmail')";
		$count = $this->db->usercontroll($table, $condition);
		if ($count > 0) {
			$dbData = $this->db->getuserData($table, $condition);
			session::start();
			session::set("login", true);
			session::set("firstName", $dbData[0]["firstName"]);
			session::set("id", $dbData[0]["id"]);
			session::set("status", $dbData[0]["status"]);
			header("Location: " . BASE_URL);
		}
		else {
			$data = array(
				'firstName' => $userData['first_name'],
				'lastName' => $userData['last_name'],
				'email' => $userData['email'],
			);
			$result = $this->db->userInsert($table, $data);
			if ($result == 1) {
				$dbData = $this->db->getuserData($table, $condition);
				session::start();
				session::set("login", true);
				session::set("firstName", $dbData[0]["firstName"]);
				session::set("id", $dbData[0]["id"]);
				session::set("status", $dbData[0]["status"]);
				header("Location: " . BASE_URL);
			}
			else {
				$mdata['msg'] = "There was a error";
				session::start();
				session::set("msg", $mdata['msg']);
				header("Location: " . BASE_URL . "/index/signIn");
			}
		}
		// $_SESSION['userData'] = $userData;
		// $_SESSION['access_token'] = (string) $accessToken;
		// header('Location: index.php');
		// exit();
	}

	public function main1(){
		echo "i am in main1 1";
		$this->main2();
		echo "i am in main1 2";
		return;
		header("Location: " . BASE_URL . "/index/blank");
	}
	public function main2(){
		echo " i am in main2 1";
		header("Location: " . BASE_URL . "/index/signIn");


	}
}