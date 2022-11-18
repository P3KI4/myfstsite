<?php
require_once("include/admfunction.php");

if (@$_GET["action"] == 'del_ipm') {
	Del_PM_Item($_GET['pm_item_id'], $_GET['st_id'], $_GET['tm_item_id']);
	echo "<br><a href='?r=$tr&st_id=" . $_GET["st_id"] . "&kmd=viewpmenu&action=edit_itm&tm_item_id=" . $_GET['tm_item_id'] . "'> Назад к меню</a>";
} else {

	if (@$_GET["kmd"] == 'viewpmenu') {
		if (@$_GET["action"] == 'menuup') {
			PodmenuUp();
		}
		if (@$_GET["action"] == 'menudown') {
			PodmenuDown();
		}


		echo "Работаем с подменю данного пункта<br><br>";

		if (@$_POST['kmd'] == 'addpm_item_name') {
			if ($_POST['content_page_name'] == '') {
				$content_page_name = 0;
			} else {
				$content_page_name = $_POST['content_page_name'];
			}
			Add_PM_ItemALL($_POST['pm_item_name'], $_GET['tm_item_id'], $_POST['pcontent_name'], $_GET['st_id'], $content_page_name);
		}
?>
		<table>
			<tr>
				<td>
					<div id='podmenuform'>
						<h2>Добавить пункт подменю</h2>
						<form method="POST">
							<table border=1 cellpadding="10" cellspacing="10">
								<tr>
									<td>Название пункта меню</td>
									<td>&nbsp;</td>
									<td><input type="text" id="pm_item_name" name="pm_item_name"></td>
								</tr>
								<tr>
									<td>Контент</td>
									<td>&nbsp;</td>
									<td><textarea style="width: 285px; height: 330px;" name="pcontent_name"></textarea></td>
								</tr>
								<tr>
									<td>Внешняя страница контента</td>
									<td>&nbsp;</td>
									<td><input type="text" id="content_page_name" name="content_page_name"></td>
								</tr>
								<tr>
									<td><input type="hidden" value="addpm_item_name" name="kmd"></td>
									<td>&nbsp;</td>
									<td><input type="submit" value="Добавить пункт" name="go"></td>
								</tr>
							</table>
						</form>
					</div>
				</td>
			</tr>
		</table>
		<?php
		Podmenu($_GET['st_id'], $_GET['tm_item_id']);
		echo "<a href='?r=$tr&st_id=" . $_GET["st_id"] . "&kmd=viewmenu'> Назад к меню</a>";
	} else {

		if (@$_GET["action"] == 'del_itm') {
			Del_TopMenu_Item($_GET["st_id"], $_GET["tm_item_id"]);
		}

		if (@$_POST['kmd'] == 'add_item_name') {
			Add_NewItemMenuALL($_POST["item_name"], $_POST["content_name"], $_GET["st_id"], $_POST["content_page_name"]);
			echo "<a href='?r=$tr&st_id=" . $_GET["st_id"] . "&kmd=viewmenu'> Назад к меню</a>";
		} else {

			if (@$_GET['kmd'] == 'viewmenu') {
				if (@$_GET["action"] == 'tmenuup') {
					MenuUP();
				}

				if (@$_GET["action"] == 'menudown') {
					MenuDown();
				}
		?>

				<table>
					<tr>
						<td>
							<div id='additemmenuform'>
								<h2>Добавить пункт меню</h2>
								<form method="POST">
									<table border=1 cellpadding="10" cellspacing="10">
										<tr>
											<td>Название пункта меню</td>
											<td>&nbsp;</td>
											<td><input type="text" id="item_name" name="item_name"></td>
										</tr>
										<tr>
											<td>Контент</td>
											<td>&nbsp;</td>
											<td><textarea style="width: 285px; height: 330px;" name="content_name"></textarea></td>
										</tr>
										<tr>
											<td>Внешняя страница контента</td>
											<td>&nbsp;</td>
											<td><input type="text" id="content_page_name" name="content_page_name"></td>
										</tr>
										<tr>
											<td><input type="hidden" value="add_item_name" name="kmd"></td>
											<td>&nbsp;</td>
											<td><input type="submit" value="Добавить пункт" name="go"></td>
										</tr>
									</table>
								</form>
							</div>
						</td>
					</tr>
				</table>
<?php

				echo 'Вы видите меню статуса: ' . Get_Status_on_ST_id($_GET['st_id']) . '<br>';
				View_TopMenu_on_Status($_GET['st_id']);
				echo "<a href='?r=$tr'> Назад к меню</a>";
			} else {

				echo "<h3>Меню</h3>";
				View_All_Statuses_For_TopMenu();
			}
		}
	}
}
