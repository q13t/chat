<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=chat user=qrt password=qrt1")
 or die('Could not connect: ' . pg_last_error());
$login=$_POST['login'];
$password=$_POST['password'];
$query=pg_query ($dbconn, "SELECT * FROM users WHERE login='$login' AND password='$password'") or die (pg_last_error());
$result = pg_fetch_array($query, NULL, PGSQL_ASSOC);

if (empty($result)){
	echo "Login Failed";
}else{
	echo "Привет {$result['nickname']} можешь начинать работать";
	header("refresh:5; dialoglist.html");
	exit;
}
pg_close($dbconn);
?>