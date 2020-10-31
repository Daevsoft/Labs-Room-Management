<?php
/**
* Session class
* Author by Muhamad Deva Arofi
*/

function set_session($__key, $__val)
{
	$_SESSION[$__key] = $__val;
}
function get_session($__key)
{
	return $_SESSION[$__key];
}
function unset_session($__key)
{
	unset($_SESSION[$__key]);
}
function exist_session($__key)
{
	return isset($_SESSION[$__key]);
}
function set_flash($__key, $__val = STRING_EMPTY)
{
	$_SESSION[$__key] = $__val;
}
function flash($__key)
{
	$_VALUE = isset($_SESSION[$__key]) ? $_SESSION[$__key] : "";
	unset($_SESSION[$__key]);
	return $_VALUE;
}
class Session
{

	function __construct()
	{
	}
	public function set($__key, $__val)
	{
		$_SESSION[$__key] = $__val;
	}
	public function get($__key)
	{
		return $_SESSION[$__key];
	}
	public function set_flash($__key, $__val = STRING_EMPTY)
	{
		$_SESSION[$__key] = $__val;
	}
	public function flash($__key)
	{
		$_VALUE = isset($_SESSION[$__key]) ? $_SESSION[$__key] : "";
		unset($_SESSION[$__key]);
		return $_VALUE;
	}
	public function remove($__key)
	{
		unset($_SESSION[$__key]);
	}
	public function exist($__key)
	{
		return isset($_SESSION[$__key]);
	}
}
