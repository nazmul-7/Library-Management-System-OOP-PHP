<?php
/**
 *  Main Database
 */
class database extends PDO

{
	function __construct($dsn, $user, $pass)
	{
		parent::__construct($dsn, $user, $pass);
	}
	/* User Database Query */
	public function getuserdata($table, $condition = 1)

	{
		$sql = "SELECT * FROM $table where $condition ";
		$stat = $this->prepare($sql);
		$stat->execute();
		return $stat->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getQuestoinData($condition = 1){
		$sql = "SELECT questions.*, users.firstName, users.lastName, categories.name FROM questions INNER JOIN users ON questions.user_id=users.id INNER JOIN categories ON questions.category_id=categories.id where ".$condition." ORDER BY questions.id DESC ";
		$stat = $this->prepare($sql);
		$stat->execute();
		return $stat->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getAnswers($condition = 1){
		$sql = "SELECT answers.*, users.firstName, users.lastName FROM answers INNER JOIN users ON answers.user_id=users.id  where ".$condition." ORDER BY answers.id DESC";
		$stat = $this->prepare($sql);
		$stat->execute();
		return $stat->fetchAll(PDO::FETCH_ASSOC);
		// INNER JOIN categories ON answers.category_id=categories.id ORDER BY questions.id DESC
	}
	public function userInsert($table, $data){
		$keys = implode(',', array_keys($data));
		$values = ':' . implode(', :', array_keys($data));
		$sql = "INSERT into $table($keys) Values($values)";

		$stat = $this->prepare($sql);
		
		foreach($data as $key => $value) {
			$stat->bindValue(":$key", $value);
		}
		
		return $stat->execute();
	}
	public function usercontroll($table, $condition)

	{
		$sql = "SELECT *  FROM $table where $condition";
		$state = $this->prepare($sql);
		$state->execute();
		return $state->rowCount();
	}
}