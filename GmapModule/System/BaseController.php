<?php

namespace GmapModule\System;

use GmapModule\Router\IRouter;
use GmapModule\Session\ISession;
use GmapModule\View\IView;
use InvalidArgumentException;

class BaseController implements IController
{
    private IView $view;

    private ISession $session;

    private IRouter $router;

    /** @var IModel[] */
    private array $models;

    public function initAction(): void
    {
        if (method_exists($this, $this->router->getActionName())) {
            $this->initDefaults();
            call_user_func_array(
                [
                    $this,
                    $this->router->getActionName()
                ],
                $this->router->getParams()
            );
        } else {
            throw new InvalidArgumentException('Нет указанного метода в контроллер!');
        }
    }

    /** @inheritdoc */
    public function setView(IProvider $view): self
    {
        $this->view = $view;

        return $this;
    }

    /** @inheritdoc */
    public function setModel(IProvider $model): self
    {
        if (!array_key_exists($model::class, $this->models)) {
            $this->models[$model::class] = $model;
        }

        return $this;
    }

    /** @inheritdoc */
    public function setSession(IProvider $session): self
    {
        $this->session = $session;

        return $this;
    }

    /** @inheritdoc */
    public function setRouter(IProvider $router): self
    {
        $this->router = $router;

        return $this;
    }

    /** @inheritdoc */
    public function view(): IProvider
    {
        return $this->view;
    }

    /** @inheritdoc */
    public function model(string $modelName): IProvider
    {
        $this->setModel(Provider::get($modelName));

        return $this->models[$modelName];
    }

    /** @inheritdoc */
    public function session(): IProvider
    {
        return $this->session;
    }

    /** @inheritdoc */
    public function router(): IProvider
    {
        return $this->router;
    }

    protected function initDefaults(): void
    {
        $this->view->setFolder($this->router->getControllerName());
    }
}