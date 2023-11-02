<?php

namespace GmapModule\Config;

use Exception;
use GmapModule\Libraries\Helper;

class EnvConfig implements Config
{
    /**
     * Config file for parse settings
     * @var string CONFIG_FILE
     */
    public const CONFIG_FILE = '~/.env';

    /** Read & parse settings
     * @throws Exception
     */
	public function __construct()
	{
		$envFile = Helper::readFile(self::CONFIG_FILE);
		$this->parseEnv($envFile);
	}

	/**
	* Parse env file
	* @param string $envFile
	* @return void
	*/
	private function parseEnv(string $envFile): void
	{
		$arrayData = explode("\n", $envFile);

		if($arrayData && is_array($arrayData)) {
			foreach($arrayData as $data) {
				$data = trim($data);
				if($data) {
					$this->set($data);
				}
			}
		}
	}

	/** Set each setting */
	public function set(string $data): void
	{
		putenv($data);
	}

	/** Get setting */
	public function get(string $key): string
	{
		return getenv($key) ?? '';
	}
}