<?php

namespace GmapModule\Router;

use GmapModule\System\IController;
use GmapModule\System\IProvider;

interface IRouter extends IProvider
{
    public function getController(): IController;

    public function getControllerName(): string;

    public function getActionName(): string;

    /** @return string[] */
    public function getParams(): array;
}