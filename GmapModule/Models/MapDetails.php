<?php

namespace GmapModule\Models;

use GmapModule\System\BaseController;

class MapDetails extends BaseController
{
    protected function table(): string
    {
        return 'map_details';
    }
}