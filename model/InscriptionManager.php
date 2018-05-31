<?php 

require_once('Manager.php');


class InscriptionManager extends Manager
{

	//Add a nem member
	function inscription($pass_hash)
	{
		$db = $this->getDb();

		$req = $db->prepare('INSERT INTO members (name, email, password, confirmed, inscription_date) VALUES (:name, :email, :password, :confirmed, NOW())');

		/*$token = str_random(60);*/

		/*$user_id = $db->lastInsertId();*/

		$req->bindValue(':name', $_POST['username'], PDO::PARAM_STR);
		$req->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
		$req->bindValue(':password', $pass_hash, PDO::PARAM_STR);
		$req->bindValue(':confirmed', 0, PDO::PARAM_INT);


		$req->execute();

	/*	mail($_POST['email'], 'Account confirmation', "To validate your account, please click on this link\n\nhttp://localhost/blog/index.php?id=$user_id&token=$token");*/
	}
	
	
	// Check the username doesn't allready exist
	function nameCheck()
	{
		$db = $this->getDb();
		
		$req = $db->prepare('SELECT name FROM members WHERE name = :name');

		$req->bindValue('name', $_POST['username'], PDO::PARAM_STR);
		$req->execute();

		$user_name = $req->fetch();	
		
		return $user_name;
	}

	
	// Check the email doesn't allready exist
	function emailCheck()
	{
		$db = $this->getDb();
		
		$req = $db->prepare('SELECT email FROM members WHERE email = :email');

		$req->bindValue('email', $_POST['email'], PDO::PARAM_STR);
		$req->execute();

		$user_email = $req->fetch();	
		
		return $user_email;
	}

	// Connect to the website
	function signIn()
	{
		$db = $this->getDb();

		$req =$db->prepare('SELECT id, password FROM members WHERE name = :name');

		$req->bindValue('name', $_POST['loginName'], PDO::PARAM_STR);
        $req->execute();

		$result = $req->fetch();

		return $result;
	}
}
	
  
 
