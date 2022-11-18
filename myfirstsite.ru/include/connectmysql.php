<?php

function Connect_db($host, $user, $password, $dbname)
{

	$db = mysql_connect($host, $user, $password) or die(mysql_error());

	if (!$db) {
		echo ('<center><p><b>Невозможно подключиться к севреру базы данных</b></p></center>');
		exit();
	}

	if (!@mysql_select_db($dbname, $db)) {
		echo ('<center><p><b>База данных' . $dbname . 'недоступна!</b></p></center>');
		exit();
	} else {
		//echo('<center><p><b>Подключение к базе данных'.$dbname.'выполнено!</b></p></center>');
	}
	return $db;
}
