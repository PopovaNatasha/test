<?php

function getProtocolList(): array
{
	$connection = getDbConnection();

	$query = 'SELECT * FROM PROTOCOL_TABLE';
	$queryResult = mysqli_query($connection, $query);
	if (!$queryResult)
	{
		$error = mysqli_errno($connection) . ': ' . mysqli_error($connection);
		throw new Exception($error);
	}

	$protocols = [];
	while ($row = mysqli_fetch_assoc($queryResult))
	{
		$protocols[] = $row;
	}

	return $protocols;
}

function addProtocol(int $number, string $date, string $responsible, $compliance)
{
	$connection = getDbConnection();

	$responsible = mysqli_real_escape_string($connection, $responsible);

	$query = "INSERT INTO PROTOCOL_TABLE (NUMBER, DATE_OF_ISSUE, RESPONSIBLE, COMPLIANCE)
			  VALUES ('$number', '$date', '$responsible', '$compliance');";

	$queryResult = mysqli_query($connection, $query);
	if (!$queryResult)
	{
		$error = mysqli_errno($connection) . ': ' . mysqli_error($connection);
		throw new Exception($error);
	}
}

function getProtocolByNumber(int $number)
{
	$connection = getDbConnection();

	$query = "SELECT NUMBER FROM PROTOCOL_TABLE WHERE NUMBER = '$number'";
	$queryResult = mysqli_query($connection, $query);
	if (!$queryResult)
	{
		$error = mysqli_errno($connection) . ': ' . mysqli_error($connection);
		throw new Exception($error);
	}

	return mysqli_fetch_array($queryResult);
}