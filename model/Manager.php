<?php
// Database connection
class Manager
{
	protected function getDb()
	{	
		$db = new PDO('mysql:host=localhost;dbname=ecrivain;charset=utf8', 'root', '');

		return $db;
	}
}
