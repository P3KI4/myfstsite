<?php
if (@$_GET['r']) {
	$tr = $_GET['r'];
} else {
	$tr = 1;
};
if (@$_GET['pm']) {
	$tpm = $_GET['pm'];
} else {
	$tpm = 0;
};
if (@$_GET['article_id']) {
	$article_id = $_GET['article_id'];
} else {
	$article_id = 0;
};


$title_site = "";

$host = "127.0.0.1:3306";
$dbuser = "root";
$dbpass = "";
$dbname = "site1";

$t_users = "users";
$t_status = "status";
$t_mainmenu = "mainmenu";
$t_podmenu = "podmenu";
$t_nsp = "newspapers";
$t_admmenu = "admmenu";
