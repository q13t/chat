<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=chat user=qrt password=qrt1")
 or die('Could not connect: ' . pg_last_error());


$nickname=$_POST['regnick'];

/*Проверяем не занят ли псевдоним*/

$query = pg_query($dbconn, "SELECT * FROM users WHERE nickname='$nickname'");
$result = pg_fetch_array($query, NULL, PGSQL_ASSOC);

if (!empty($result)){
	echo "NOT OK";
}else{
    echo "SHOOPDAWHOOP";
}
pg_close($dbconn);
?>