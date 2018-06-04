<?php
// Database connection
class Manager
{
	protected function getDb()
	{	
		$db = new PDO('mysql:host=localhost;dbname=writer;charset=utf8', 'root', '');

		return $db;
	}
}
