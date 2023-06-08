<?php

function getDbConnection()
{
	static $connection = null;

	if ($connection === null)
	{
		$host = option('DB_NAME');
		$userName = option('DB_USER');
		$password = option('DB_PASSWORD');
		$dbName = option('DB_NAME');

		$connection = mysqli_init();

		$connectionResult = mysqli_real_connect($connection, $host, $userName, $password, $dbName);
		if (!$connectionResult)
		{
			$error = mysqli_connect_errno() . ': ' . mysqli_connect_error();
			throw new Exception($error);
		}

		$encodingResult = mysqli_set_charset($connection, 'utf8');
		if (!$encodingResult)
		{
			$error = mysqli_errno($connection) . ': ' . mysqli_error($connection);
			throw new Exception($error);
		}
	}

	return $connection;
}