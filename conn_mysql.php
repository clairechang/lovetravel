<?php 
// 例外處理(Exception)
	try 
	{
		// connect
		$dsn = 'mysql:host=localhost;dbname=lovetravel;charset=utf8';
		$username = 'root';
		$password = '12345678';
	
		$db = new PDO ( $dsn, $username, $password);

		//mysql_connect('localhost', $username, $password) or die ('MySQL Not found // Could Not Connect.');
		//mysql_select_db("lovetravel") or die ("No Database found.");
		
	} 
	catch (Exception $e)
	{
		echo $e->getMessage();	
	}
?>