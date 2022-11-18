<?php


require_once("include/config.php");
require_once("include/function.php");
$bd = Connect_db($host, $dbuser, $dbpass, $dbname);
$mas_menu = array("О нас", "Статусы", "Пользователи", "Меню", "Статьи");

function adm_menu()
{
	global $mas_menu;
	global $tr;

	echo "<table border=1 width=100% cellpadding=5 cellspacing=1>";
	echo "<tr>";
	for ($i = 0; $i < count($mas_menu); $i++) {
		echo "<td";
		if ($tr == $i) {
			echo "background-color = silver";
		}
		echo '>';
		echo "<a href='?r=$i'>" . $mas_menu[$i] . "</a>";
		echo "</td>";
	}
	echo "</tr>";
	echo "</table>";
}

function f_sqlresult($psql)
{

	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$rez = mysqli_query($db, $psql);
	while ($rs = mysqli_fetch_array($rez)) {
		$tempvar = $rs['sqlresult'];
	}
	return $tempvar;
}

function Check_Status($l, $p)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT status_id FROM users WHERE (user_login='$l') and (user_pass = '$p')";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	$st_id = mysqli_fetch_array($result);
	$status_id = $st_id['status_id'];
	return $status_id;
}

function Get_User_id($l, $p)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT id FROM users WHERE (user_login='$l') and (user_pass = '$p')";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	$usr_id = mysqli_fetch_array($result);
	$user_id = $usr_id['id'];
	return $user_id;
}

function Is_User_Activate($l, $p)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT activation FROM users WHERE (user_login='$l') and (user_pass = '$p')";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	$act_id = mysqli_fetch_array($result);
	$activation = $act_id['activation'];
	if ($activation == 1) {

		echo "Данный пользователь активирован";
	} else {
		echo "Данный пользователь не активирован";
	}
}

function f_proverka($l, $p)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	global $tadmdosup;
	$sql = "select count(*) as sqlresult from users where (user_login='$l') and (user_pass='$p')";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	$admin = mysqli_fetch_array($result);
	$adm = $admin['sqlresult'];
	$st_id = Check_status($l, $p);
	if (($adm > 0) && ($st_id == 1)) {
		$tadmdosup = 1;
		$usr_id = Get_User_id($l, $p);
	} else {
		$tadmdosup = 0;
	}

	$_SESSION['admdostup'] = $tadmdosup;
	$_SESSION['user_id'] = $usr_id;
}

function View_All_Statuses()
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT status_title FROM status";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));

	echo "<table border=1 cellpadding=5 cellspacing=1>";
	echo "<tr>";
	echo "<td style='font-weight: bold; display: block'>Статус пользователя</td>";
	while ($rs = mysqli_fetch_array($result)) {
		echo "<td style='display: block'>" . $statuses = $rs['status_title'] . "<br>";
		echo "</td>";
	}
	echo "</tr>";
	echo "</table>";
}

function View_All_Statuses1()
{
	global $tr;
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT id, status_title FROM status where id != 1";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	echo "<table border=1 cellpadding=5 cellspacing=1>";
	echo "<tr><tr>";
	echo "Статус пользователя";
	echo "</tr></td>";
	while ($st = mysqli_fetch_array($result)) {
		echo "<tr><td>";
		echo $st['status_title'] . "<a href='?r=" . $tr . "&st_id=" . $st["id"] . "&kmd=delstatus'>X</a>";
		echo "</td</tr>";
	};
	echo "</table>";
}

function View_All_Statuses2()
{
	global $tr;
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT id, status_title FROM status";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	echo "<table border=1 cellpadding=5 cellspacing=1>";
	echo "<tr><tr>";
	echo "Статус пользователя";
	echo "</tr></td>";
	while ($st = mysqli_fetch_array($result)) {
		if ($st['id'] != 1) {
			echo "<tr><td>";
			echo $st['status_title'] . "<a href='?r=" . $tr . "&st_id=" . $st["id"] . "&kmd=delstatus'>X</a>";
			echo "</td</tr>";
		}
	};
	echo "</table>";
}

function View_All_Statuses_For_TopMenu()
{
	global $tr;
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT id, status_title FROM status";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	echo "<table border=1 cellpadding=5 cellspacing=1>";
	echo "<tr><th>";
	echo "Статус пользователя";
	echo "</th>";
	echo "<th>";
	echo "Меню";
	echo "</th></tr>";
	while ($st = mysqli_fetch_array($result)) {
		if ($st['id'] != 1) {
			echo "<tr><td>";
			echo $st['status_title'];
			echo "</td><td>" . "<a href='?r=" . $tr . "&st_id=" . $st["id"] . "&kmd=viewmenu'>menu</a>";
			echo "</td></tr>";
		}
	};
	echo "</table>";
}




function All_Reg_Users()
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT user_name, user_fname, user_login, status_id, activation FROM users where status_id != 1";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	echo "<table border=1 cellpadding=5 cellspacing=1>";
	echo "<tr><td>";
	echo "Фамилиия";
	echo "</td>";
	echo "<td>";
	echo "Имя";
	echo "</td>";
	echo "<td>";
	echo "Логин";
	echo "</td>";
	echo "<td>";
	echo "Статус";
	echo "</td>";
	echo "<td>";
	echo "Активирован";
	echo "</td>";
	echo "<tr>";
	while ($rs = mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>" . $users_name = $rs['user_name'] . "</td>" .
			" <td> " . $users_f = $rs['user_fname'] . "</td>" .
			" <td>" . $users = $rs['user_login'] . "</td>" .
			" <td> " . $status_id = Get_Status_on_ST_id($rs['status_id']) . "</td>" .
			" <td> " . $user_activation = Active_Or_Not($rs['activation']);
		echo "</td> </tr>";
	}
	echo "</tr>";
	echo "</table>";
}

function Active_Or_Not($st)
{
	if ($st == 1) {
		return $st = "Да";
	} else {
		return $st = "Нет";
	}
}

function Get_Status_on_ST_id($st_id)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT status_title FROM status where id =" . $st_id;
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	$status_title = mysqli_fetch_array($result);
	$status = $status_title['status_title'];
	return $status;
}

function Add_NewStatus($new_st)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "INSERT INTO status(status_title) VALUES ('$new_st')";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	if (!$result) {
		return false;
	}
}

function Add_PMenu($item_name, $st_id)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "INSERT INTO mainmenu(item_name, vidimost, menu_content, user_status_id, content_page)\n"
		. "VALUES ('$item_name',1,'','$st_id', '')";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	if (!$result) {
		return false;
	}
}

function Add_NewItemMenuALL($item_name, $content, $st_id, $contentpage)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$temppn = f_sqlresult("select count(id) as sqlresult from mainmenu");
	$temppn++;
	$sql = "INSERT INTO mainmenu(item_name, pn, vidimost, menu_content, user_status_id, content_page)\n"
		. "VALUES ('$item_name', $temppn, 1, '$content' ,$st_id,  '$contentpage')";
	echo $sql;
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));

	if (!$result) {
		return false;
	}
}


function Del_Status($st_id)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "DELETE FROM status WHERE id =" . $st_id;
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	if (!$result) {
		return false;
	}
}

function Del_TopMenu_Item($st_id, $tm_menu_id)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "DELETE FROM mainmenu WHERE id =" . $tm_menu_id . " and user_status_id =" . $st_id;
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	$sql1 = "DELETE FROM podmenu WHERE menu_id =" . $tm_menu_id . " and status_id =" . $st_id;
	$result1	 = mysqli_query($db, $sql1) or die(mysqli_error($db));
	if (!$result) {
		return false;
	}
}

function Del_PM_Item($pm_item_id, $st_id, $tm_item_id)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "DELETE FROM podmenu WHERE (id = " . $pm_item_id . " and status_id = " . $st_id . " and menu_id = " . $tm_item_id . ")";
	echo $sql;
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	if (!$result) {
		return false;
	}
}

function Add_PM_Item($pm_item_name, $tmenu_id, $st_id)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "INSERT INTO podmenu(podmenu_item, menu_id, status_id) VALUES ('" . $pm_item_name . "',  $tmenu_id ,  $st_id )";
	echo $sql;
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
}

function Add_PM_ItemALL($pm_item_name, $tmenu_id, $content, $st_id, $contentpage)
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$temppn = f_sqlresult("select count(id) as sqlresult from podmenu where (menu_id = $tmenu_id)");
	$temppn++;
	$sql = "INSERT INTO podmenu(podmenu_item, pn, menu_id, content, is_article, status_id, content_page) VALUES ('$pm_item_name', $temppn, $tmenu_id, '$content', 0, $st_id,  $contentpage )";
	echo $sql;
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
}


function View_TopMenu_on_Status($st_id)
{
	global $tr;
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT id, item_name FROM mainmenu WHERE user_status_id =" . $st_id . " and vidimost = 1 order by pn asc";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	echo "<table border=1 cellpadding=5 cellspacing=1>";
	while ($menu_st = mysqli_fetch_array($result)) {
		echo "<tr><td>";
		echo $menu_st["item_name"];
		echo "</td>";
		echo "<td>";
		echo "<a href='?r=" . $tr . "&st_id=" . $_GET["st_id"] . "&kmd=viewmenu&action=del_itm&tm_item_id=" . $menu_st['id'] . "'>удалить </a>";
		echo "</td>";
		echo "<td>";
		//echo "<a href='?r=" . $tr . "&st_id=" . $_GET["st_id"] . "&kmd=viewmenu&action=edit_itm&tm_item_id=" . $menu_st['id'] . "'>Изменить подменю </a>";
		echo "<a href='?r=" . $tr . "&st_id=" . $_GET["st_id"] . "&kmd=viewpmenu&action=edit_itm&tm_item_id=" . $menu_st['id'] . "'>Изменить подменю </a></td>";
		echo "<td align='center'>" .
			"<a href='?r=" . $tr . "&st_id=" . $st_id . "&kmd=viewmenu&action=tmenuup&tm_item_id=" . $menu_st['id'] .  "'>Вверх</a></td>";
		echo "<td align='center'>" .
			"<a href='?r=" . $tr . "&st_id=" . $st_id . "&kmd=viewmenu&action=tmenudown&tm_item_id=" . $menu_st['id'] .  "'>Вниз</a></td>";
		echo "</tr>";
	};
	echo "</table>";
	if (!$result) {
		return false;
	}
}


function Podmenu($st_id, $menu_id)
{
	global $tr;
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$sql = "SELECT id, podmenu_item FROM podmenu where menu_id =" . $menu_id . " and status_id =" . $st_id . " order by pn asc";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	echo "<table border=1 cellpadding=5 cellspacing=1>";
	echo "<tr>";
	echo "<th>Пункты подменю</th>";
	echo "<th>Статус пользователя</th>";
	echo "<th>&nbsp;</th>";
	echo "<th>&nbsp;</th>";
	echo "<th>&nbsp;</th>";
	echo "</tr>";
	while ($pmenu = mysqli_fetch_array($result)) {

		echo "<tr><td>";
		echo $pmenu["podmenu_item"] . "</td>";
		echo "<td align='center'>" . Get_Status_on_ST_id($st_id) . "</td>";
		echo "<td align='center'><a href='?r=" . $tr . "&st_id=" . $st_id . "&kmd=viewpmenu&action=del_ipm&tm_item_id=" . $menu_id . "&pm_item_id=" . $pmenu['id'] . "'>Удалить</a>";
		echo "<td align='center'><a href='?r=" . $tr . "&st_id=" . $st_id . "&kmd=viewpmenu&action=menuup&tm_item_id=" . $menu_id . "&pm_item_id=" . $pmenu['id'] . "'>Вверх</a>";
		echo "<td align='center'><a href='?r=" . $tr . "&st_id=" . $st_id . "&kmd=viewpmenu&action=menudown&tm_item_id=" . $menu_id . "&pm_item_id=" . $pmenu['id'] . "'>Вниз</a>";
		echo "</td></tr>";
	};
	echo "</table>";
	return false;
}

function PodmenuUp()
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$tpn = f_sqlresult("select pn as sqlresult from podmenu where (id=" . $_GET['pm_item_id'] . ")");
	$id2 = $_GET['pm_item_id'];
	$var = $_GET['menu_id'];
	$id1 = f_sqlresult("select id as sqlresult from podmenu where (menu_id=" . $_GET['tm_item_id'] . ") and (pn= " . $tpn . "-1)");
	$upd1 = "update podmenu set pn=pn-1 where (id=$id2)";
	$upd2 = "update podmenu set pn=pn+1 where (id=$id1)";
	if ($id1 != '') {
		mysqli_query($db, $upd1);
		mysqli_query($db, $upd2);
	} else {
		echo 'Поднимать вверх некуда';
	}
}

function PodmenuDown()
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));
	$tpn = f_sqlresult("select pn as sqlresult from podmenu where (id=" . $_GET['pm_item_id'] . ")");
	$id2 = $_GET['pm_item_id'];
	$id1 = f_sqlresult("select id as sqlresult from podmenu where (menu_id=" . $_GET['tm_item_id'] . ") and (pn= $tpn+1)");
	$upd1 = "update podmenu set pn=pn+1 where (id=$id2)";
	$upd2 = "update podmenu set pn=pn-1 where (id=$id1)";
	if ($id1 != '') {
		mysqli_query($db, $upd1);
		mysqli_query($db, $upd2);
	} else {
		echo 'Опускать вниз некуда';
	}
}


function MenuUP()
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));

	$tpn = f_sqlresult("select pn as sqlresult from mainmenu where (id=" . $_GET['tm_item_id'] . ")");
	$id2 = $_GET['tm_item_id'];
	$id1 = f_sqlresult("select id as sqlresult from mainmenu where (pn=$tpn-1)");

	/*$upd1 = "update podmenu set pn=-pn where (id=$id2)";
	$upd2 = "update podmenu set pn=pn+1 where (id=$id1)";
	$upd3 = "update podmenu set pn=-pn-1 where (id=$id2)";
	if ($id1 != '') {
		mysqli_query($db, $upd1);
		mysqli_query($db, $upd2);
		mysqli_query($db, $upd3);*/

	$upd1 = "update podmenu set pn=pn-1 where (id=$id2)";
	$upd2 = "update podmenu set pn=pn+1 where (id=$id1)";
	if ($id1 != '') {
		mysqli_query($db, $upd1);
		mysqli_query($db, $upd2);
	} else {
		echo 'Поднимать вверх некуда';
	}
}

function MenuDown()
{
	$db = mysqli_connect("127.0.0.1:3306", "root",  "", "site1") or die(mysqli_error($db));

	$tpn = f_sqlresult("select pn as sqlresult from mainmenu where (id=" . $_GET['tm_item_id'] . ")");
	$id2 = $_GET['tm_item_id'];
	$id1 = f_sqlresult("select id as sqlresult from mainmenu where (pn=$tpn+1)");

	$upd1 = "update podmenu set pn=-pn where (id=$id2)";
	$upd2 = "update podmenu set pn=pn-1 where (id=$id1)";
	$upd3 = "update podmenu set pn=-pn+1 where (id=$id2)";
	if ($id1 != '') {
		mysqli_query($db, $upd1);
		mysqli_query($db, $upd2);
		mysqli_query($db, $upd3);
	} else {
		echo 'Опускать вниз некуда';
	}
}
