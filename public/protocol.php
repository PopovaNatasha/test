<?php

require_once __DIR__ . '/../boot.php';

session_start();
if (hasError())
{
	?>
	<script>
		alert('<?= showErrors() ?>')
	</script>
	<?php
	unsetErrors();
}

try
{
	$protocols = getProtocolList();
}
catch (Exception $exception)
{
	echo $exception->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Протоколы</title>
</head>
<body>
<div>
	<table>
		<caption>Таблица протоколов</caption>
		<tr>
			<th>№ п\п</th>
			<th>Номер протокола</th>
			<th>Дата выдачи (дд.мм.гг)</th>
			<th>Ответственный (ФИО)</th>
			<th>Соответствие («да», «нет»)</th>
		</tr>
		<?php foreach ($protocols as $key => $protocol): ?>
			<tr>
				<td><?= $key + 1 ?></td>
				<td><?= $protocol['NUMBER'] ?></td>
				<td><?= formatDate($protocol['DATE_OF_ISSUE']) ?></td>
				<td><?= htmlspecialchars($protocol['RESPONSIBLE']) ?></td>
				<td><?= $protocol['COMPLIANCE'] === '1' ? 'да' : 'нет' ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<button class="add-protocol" onclick="openForm()">Добавить протокол</button>

<div class="form-add-protocol" id="addForm" style="display: none;">
	<form action="/addProtocol.php" method="post">
		<h1>Добавить протокол</h1>

		<label for="number"><b>Номер протокола</b></label>
		<input type="text" placeholder="Введите номер протокола" name="number" required>

		<label for="date"><b>Дата выдачи</b></label>
		<input type="date" name="date" required>

		<label for="responsible"><b>Ответсвенный</b></label>
		<input type="text" placeholder="Введите ФИО ответственного" name="responsible" required>

		<label for="compliance"><b>Соответсвует нормам</b></label>
		<input type="checkbox" name="compliance">

		<button type="submit" class="btn">Сохранить</button>
		<button type="button" class="btn cancel" onclick="closeForm()">Закрыть</button>
	</form>
</div>
</body>
</html>

<script>
	function openForm() {
		document.getElementById("addForm").style.display = "block";
	}

	function closeForm() {
		document.getElementById("addForm").style.display = "none";
	}
</script>