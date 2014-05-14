<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=chat user=qrt password=qrt1")
 or die('Could not connect: ' . pg_last_error());

$login=$_POST['reglogin'];
$password=$_POST['regpass'];
$nickname=$_POST['regnick'];

/*Проверяем не занят ли логин*/

$query = pg_query($dbconn, "SELECT * FROM users WHERE nickname='$nickname'");
$result = pg_fetch_array($query, NULL, PGSQL_ASSOC);

if (!empty($result)){
	exit("Данный псевдоним уже занят, пожалуйста выберите другой.");
}else{
/* Логин свободен - продолжаем регистрировать */
/* Можно проверить пароль на длинну */
if (mb_strlen($password, 'UTF-8') < 6){
	exit("Пароль не надежен");
}else{
/* пароль надежен, впринцепи можно и зарегить*/
	$query2 = pg_query($dbconn, "INSERT INTO users(login, password, nickname) 
                  VALUES('$login','$password','$nickname')");
 	if ($query2) {
        echo "<p>Вы успешно зарегестрированы, <br> сейчас вы будете перенаправлены на страницу входа, откуда вы сможете войти используя свои логин и пароль.</p>";
        header("refresh:5; login.html");
		exit;
    } else {
        echo "<p>ERROR.</p>";
    }
}
}
pg_close($dbconn);
?>