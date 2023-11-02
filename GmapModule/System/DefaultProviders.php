<?php

namespace GmapModule\System;

use GmapModule\Config\EnvConfig;
use GmapModule\Router\Router;
use GmapModule\Session\PhpSession;
use GmapModule\View\View;
use GmapModule\Database\PdoDatabase;

enum DefaultProviders: string
{
	case CONFIG = EnvConfig::class;

	case SESSION = PhpSession::class;

	case DB = PdoDatabase::class;

	case VIEW = View::class;

	case ROUTER = Router::class;
}