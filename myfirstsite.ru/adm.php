<?php
require_once("include/config.php");
require_once("include/function.php");
require_once("include/admfunction.php");
$bd = Connect_db($host, $dbuser, $dbpass, $dbname);

session_start();
if (!isset($_SESSION['admdostup'])) {
	$_SESSION['admdostup'] = '';
}
if (@$_GET['exit']) {
	$_SESSION['admdostup'] = '';
}
$tadmdosup = $_SESSION['admdostup'];

if ((@$_POST["user_login"]) and (@$_POST["user_pass"])) {
	f_proverka($_POST["user_login"], $_POST["user_pass"]);
}

if ($tadmdosup == 1) {
	echo "Административный интерфейс сайта: user_id=" . $_SESSION['user_id'] . "";
	adm_menu();
	echo "<a href='adm.php?exit=yes'>Выход</a><br><br>";
	if ($tr == 0) {
		include("admabout.php");
	};
	if ($tr == 1) {
		include("admstatus.php");
	};
	if ($tr == 2) {
		include("admusers.php");
	};
	if ($tr == 3) {
		include("admmenu.php");
	};
	if ($tr == 4) {
		include("admpages.php");
	};
} else {
	include('admlogin.php');
}
