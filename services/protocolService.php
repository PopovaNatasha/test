<?php

function isProtocolExist(int $number): bool
{
	$protocol = getProtocolByNumber($number);

	if ($protocol)
	{
		return true;
	}
	else
	{
		return false;
	}
}