<?php

namespace GmapModule\Session;

use GmapModule\System\IProvider;

interface ISession extends IProvider
{
	/** Check has session */
	public function has(string $key): bool;

	/** Add Session */
	public function set(string $key, string $value): void;

	/**  Get Session */
	public function get(string $key): string;
}