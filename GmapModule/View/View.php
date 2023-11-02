<?php

namespace GmapModule\View;

class View implements IView
{
    private string $folder;

    public function render(string $template): void
    {

    }

    public function setFolder(string $folderName): void
    {
        $this->folder = $folderName;
    }
}