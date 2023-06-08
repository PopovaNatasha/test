<?php

function setError(string $error): void
{
	session_start();
	$_SESSION['errors'][] = $error;
}

function showErrors(): string
{
	return implode('\n', $_SESSION['errors']);
}

function hasError(): bool
{
	if (isset($_SESSION['errors']))
	{
		return true;
	}
	return false;
}

function unsetErrors(): void
{
	unset($_SESSION['errors']);
}