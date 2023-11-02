<?php
/**
 * @author Jafar Sharifov <sharifov@programmer.net>
 */

declare(strict_types = 1);

use GmapModule\System\GmapModule;

ini_set('display_errors', '1');
error_reporting(E_ALL);

spl_autoload_register(function($class) {
	include_once(str_replace('\\', '/', $class) . '.php');
});

new GmapModule;
