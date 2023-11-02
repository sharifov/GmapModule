<?php

namespace GmapModule\Session;

class PhpSession implements ISession
{
    /** Start Session*/
	public function __construct()
	{
		session_start();
	}

	/** @inheritdoc */
	public function has(string $key): bool
	{
		return isset($_SESSION[$key]);
	}

    /** @inheritdoc */
	public function set(string $key, string $value): void
	{
		$_SESSION[$key] = $value;
	}

    /** @inheritdoc */
	public function get(string $key): string
	{
		return $_SESSION[$key] ?? '';
	}
}