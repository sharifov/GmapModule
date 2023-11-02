<?php

namespace GmapModule\System;

use Exception;
use GmapModule\Database\IDatabase;

abstract class AbstractModel implements IModel
{
    /**
     * Set database table for use
     * @var IDatabase
     */
    private IProvider $db;

    /** @throws Exception */
    public function __construct()
    {
        $this->db = Provider::get(DefaultProviders::DB->value);
        $this->db->setTable($this->table());
    }

    abstract protected function table(): string;
}