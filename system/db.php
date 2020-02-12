<?php
class bchanDB
{
	public function conn($host, $username, $password, $db)
	{
		return mysqli_connect($host, $username, $password, $db);
	}
	public function q($conn, $query)
	{
		return mysqli_query($conn, $query);
	}

	public function checkTable($name)
	{
		$query = "SELECT * FROM $name";
		return $query;
	}
}
?>