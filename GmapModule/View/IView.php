<?php

namespace GmapModule\View;

use GmapModule\System\IProvider;

interface IView extends IProvider
{
	/** Render template */
	public function render(string $template): void;

    public function setFolder(string $folderName);
}