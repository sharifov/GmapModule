<?php

namespace GmapModule\System;

use Exception;
use GmapModule\Router\IRouter;

class GmapModule
{
    /** @var IRouter */
    private IProvider $router;

    /** @throws Exception */
    public function __construct()
	{
        $this->router = Provider::get(DefaultProviders::ROUTER->value);
        $this->router->getController()
            ->setView(Provider::get(DefaultProviders::VIEW->value))
            ->setSession(Provider::get(DefaultProviders::SESSION->value))
            ->setRouter($this->router)
        ->initAction();
	}
}