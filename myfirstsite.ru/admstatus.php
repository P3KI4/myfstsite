<?php
require_once("include/admfunction.php");

if (@$_GET['kmd'] == 'delstatus') {
	Del_Status($_GET["st_id"]);
	echo 'Статус id =' . $_GET["st_id"] . 'успешно удален';
}

if (@$_POST['kmd'] == 'add_status') {
	Add_NewStatus($_POST["status_title"]);
	echo 'Новый статус добавлен<br>';
	echo 'Новый статус: ' . $_POST['status_title'] . "<br>";
	echo "<a href='?r=$tr'>Назад к статусам</a>";
} else {
	echo "<h3>Статусы</h3>";

?>

	<table>
		<tr>
			<td>
				<div id='statusform'>
					<h2>Добавить статус</h2>
					<form method="POST">
						<table cellpadding="10" cellspacing="10">
							<tr>
								<td>Название статуса</td>
								<td><input type="text" id="status_title" name="status_title"></td>
							</tr>
							<tr>
								<td><input type="hidden" value="add_status" name="kmd"></td>
								<td><input type="submit" value="Добавить статус" name="go"></td>
							</tr>
						</table>
					</form>
				</div>
			</td>
		</tr>
	</table>

<?php
	View_All_Statuses2();
}
?>