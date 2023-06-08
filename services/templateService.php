<?php

function formatDate(string $date): string
{
	$timestamp = strtotime($date);

	return date('d.m.y', $timestamp);
}