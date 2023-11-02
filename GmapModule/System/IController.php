<?php

namespace GmapModule\System;

use GmapModule\Router\IRouter;
use GmapModule\Session\ISession;
use GmapModule\View\IView;

interface IController
{
    /** @param IView $view */
    public function setView(IProvider $view): self;

    /** @param IModel $model */
    public function setModel(IProvider $model): self;

    /** @param ISession $session */
    public function setSession(IProvider $session): self;

    /** @param IRouter $router */
    public function setRouter(IProvider $router): self;

    /** @return IView */
    public function view(): IProvider;

    /** @return IModel */
    public function model(string $modelName): IProvider;

    /** @return ISession */
    public function session(): IProvider;

    /** @return IRouter */
    public function router(): IProvider;
}