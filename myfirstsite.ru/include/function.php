<?php

//include("include/config.php");
//require("include/config.php");
//include_once("include/config.php");
//require_once("include/config.php");

function Connect_db($host, $user, $password, $dbname)
{
	$db = mysqli_connect($host, $user, $password) or die(mysqli_error($db));

	if (!$db) {
		echo ('<center><p><b>Невозможно подключиться к севреру базы данных</b></p></center>');
		exit();
	}

	if (!@mysqli_select_db($db, $dbname)) {
		echo ('<center><p><b>База данных' . $dbname . 'недоступна!</b></p></center>');
		exit();
	} else {
		//echo ('<center><p><b>Подключение к базе данных ' . $dbname . ' выполнено!</b></p></center>');
	}
	return $db;
}

function c_sqlresult($psql)
{

	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$rez = mysqli_query($db, $psql);
	while ($rs = mysqli_fetch_array($rez)) {
		$tempvar = $rs['sqlresult'];
	}
	return $tempvar;
}

function top_menu($st_id)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT id, pn, item_name FROM mainmenu WHERE vidimost=1 and user_status_id = " . $st_id . " order by pn asc";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	echo ('<nav><ul>');
	while ($main_top_menu = mysqli_fetch_array($result)) {
		echo "<li><a href='?r=" . $main_top_menu["id"] . "'> " . $main_top_menu["item_name"] . "</a><li>";
	}
	echo ('</ul></nav>');
	if (!$result) {
		return false;
	}
}

function top_menu_min_id($st_id)
{
	global $tr;
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));

	$sql = "SELECT MIN(id) as r FROM mainmenu WHERE user_status_id=" . $st_id;
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	$menu_id = mysqli_fetch_array($result);
	$tr_id = $menu_id["r"];
	return $tr_id;
}

function podmenu_left($st_id)
{
	global $tr;
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT id, 	podmenu_item FROM podmenu WHERE (menu_id = " . $tr . " and status_id= " . $st_id . ");";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	echo ('<aside><ul>');
	while ($left_menu = mysqli_fetch_array($result)) {
		echo "<li><a href='?r=" . $tr . "&pm=" . $left_menu["id"] . "'>" . $left_menu["podmenu_item"] . "</a><li>";
	}
	echo ('</ul></aside>');
	if (!$result) {
		return false;
	}
}

function Content()
{
	global $r;
	global $tr;
	switch ($r) {
		default:
			if ($tr == top_menu_min_id(3)) {
				echo ($content = c_sqlresult("select menu_content as sqlresult from mainmenu where (id=$tr)"));
			} else {
				$content = c_sqlresult("select menu_content as sqlresult from mainmenu where (id=$tr)");
				echo $content;
				break;
			}
	}
}

function ContentPM()
{
	global $tpm;
	echo "Контент для пункта подменю с id=$tpm <br><br><br>";

	$content = c_sqlresult("select content as sqlresult from podmenu where (id=$tpm)");
	echo $content;
}

function ContentPMArticle($st_id)
{
	global $tpm;
	global $tr;
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT content, is_article FROM podmenu WHERE (id=$tpm and status_id=$st_id)";

	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	$content_article = mysqli_fetch_array($result);
	$article_exist = $content_article["is_article"];
	$content = $content_article["content"];
	if ($article_exist != 0) {
		$sql_article = "SELECT id, nsp_title from newspapers where (podmenu_id=$tpm and status_id=$st_id)";
		$result = mysqli_query($db, $sql_article) or die(mysqli_error($db));
		echo "Список статей пункта подменю с id=" . $tpm . " <br>";
		echo "<ul id='articlesdb'>";
		while ($articles = mysqli_fetch_array($result)) {
			echo "<li><a href='?r=$tr&pm=$tpm&article_id=" . $articles['id'] . "'>" . $articles['nsp_title'] . "</a></li>";
		}
		echo "</ul>";
	} else {
		echo "Контент для пункта подменю с id=" . $tpm . " <br>";
		echo $content;
	}
}

function View_Article($st_id)
{
	global $article_id;
	global $tpm;
	global $tr;
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT nsp_title, nsp_text, content_page FROM newspapers WHERE (id=$article_id and podmenu_id=$tpm and vidimost=1 and status_id=$st_id)";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	while ($content = mysqli_fetch_array($result)) {
		$page_content = $content['content_page'];
		if ($page_content == null) {
			echo "<h3>" . $content['nsp_title'] . "</h3>";
			echo $content['nsp_text'] . "<br><br><br>";
			echo "<p><a href='?r=$tr&pm=$tpm'>Назад</a></p>";
		} else {
			if (file_exists("./newspapers/" . $page_content . ".php")) {
				include("./newspapers/" . $page_content . ".php");
				break;
			} else {
				echo "Отсутсвует страница, прописанная для подключения!";
			}
		}
	}
}
