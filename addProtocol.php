<?php

require_once __DIR__ . '/boot.php';

if ($_POST['number'] === '' || $_POST['date'] === '' || $_POST['responsible'] === '')
	{
		$error = 'Все поля должны быть заполнены';
		setError($error);
		header('Location: /public/protocol.php');
		exit();
	}

$number = (int)$_POST['number'];

if ($number === 0)
{
	$error = 'Некорректный номер протокола';
	setError($error);
	header('Location: /public/protocol.php');
	exit();
}

if (isProtocolExist($number))
{
	$error = 'Протокол с таким номером уже существует';
	setError($error);
	header('Location: /public/protocol.php');
	exit();
}

if (!strtotime($_POST['date']))
{
	$error = 'Некорректная дата';
	setError($error);
	header('Location: /public/protocol.php');
	exit();
}

$compliance = $_POST['compliance'] === NULL ? 0 : 1;
$date = $_POST['date'];
$responsible = $_POST['responsible'];

try
{
	addProtocol($number, $date, $responsible, $compliance);
	header('Location: /public/protocol.php');
}
catch (Exception $exception)
{
	echo $exception->getMessage();
}



