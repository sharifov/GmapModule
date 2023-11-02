<?php

namespace GmapModule\Config;

use GmapModule\System\IProvider;

interface Config extends IProvider
{
	/**
	* Set Config
	*/
	public function set(string $data): void;

	/**
	* Get Config
	*/
	public function get(string $key): string;
}