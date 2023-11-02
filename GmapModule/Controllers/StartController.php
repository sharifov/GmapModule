<?php

namespace GmapModule\Controllers;

use GmapModule\System\BaseController;

class StartController extends BaseController
{
    public function index(): void
    {
        $this->view()->render();
    }
}