<?php

namespace GmapModule\Database;

use Exception;
use GmapModule\Config\Config;
use GmapModule\System\DefaultProviders;
use GmapModule\System\IProvider;
use GmapModule\System\Provider;
use PDO;
use PDOException;

class PdoDatabase implements IDatabase
{
    private string $host;

    private string $user;

    private string $db;

    private string $pass;

    private string $prefix;

    private string $tableName;

    private PDO $conn;

    /** @var Config */
    private IProvider $config;

    /** Connect & set params process
     * @throws Exception
     */
    public function __construct()
    {
        $this->config = Provider::get(DefaultProviders::CONFIG->value);
        $this->setParams();
        $this->connect();
    }

    /**
    * Update record
    * @param string[] $where
    * @param string[] $options
    */
    public function update(array $where = [], array $options = []): bool
    {
        if (empty($options) || empty($where)) {
            return false;
        }

        $updateFields = '';
        foreach ($options as $field => $option) {
            $updateFields .= $field . '=' . (is_array($option) ? end($option) : $this->conn->quote($option)) . ', ';
        }
        $updateFields = rtrim($updateFields, ', ');

        $whereFields = '';
        foreach ($where as $field => $value) {
            $whereFields .= $field . '=' . $this->conn->quote($value) . ' AND ';
        }
        $whereFields = rtrim($whereFields, ' AND');

        try {
            $this->conn->query('UPDATE ' . $this->getTableName() . ' SET ' . $updateFields . ' WHERE ' . $whereFields);
            return true;
        } catch (Exception $e) {
            trigger_error("Update query failed: " . $e->getMessage());
        }

        return false;
    }

    /**
    * Insert data to database
    * @param string[] $options
    */
    public function insert(array $options = []): bool
    {
        if (empty($options)) {
            return false;
        }
        
        $fields = implode(', ', array_keys($options));
        $values = '';
        foreach ($options as $option) {
            $values .= $this->conn->quote($option) . ', ';
        }
        $values = rtrim($values, ', ');

        try {
            $this->conn->query('INSERT INTO ' . $this->getTableName() . ' (' . $fields . ') VALUES (' . $values . ')');
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            trigger_error("Insert query failed: " . $e->getMessage());
        }

        return false;
    }

    /** Delete record */
    public function delete(int $id): bool
    {
        /**
        * @todo Delete record process
        */
        return false;
    }

    /** Set table name which uses */
    public function setTable(string $tableName): void
    {
        if ((empty($this->tableName) || $this->tableName != $tableName)) {
            $this->tableName = $tableName;
        }
    }

    /** Set database credentials */
    private function setParams(): void
    {
        $this->host = $this->config->get('DB_HOST');
        $this->user = $this->config->get('DB_USER');
        $this->db = $this->config->get('DB_NAME');
        $this->pass = $this->config->get('DB_PASS');
        $this->prefix = $this->config->get('DB_PREFIX');
    }

    /** Connect to database with PDO */
    private function connect(): void
    {
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db . ';charset=utf8', $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            trigger_error('ERROR: ' . $e->getMessage()); 
            exit;
        }
    }

    /**  Get table real name */
    private function getTableName(): string
    {
        return $this->tableName ? ($this->prefix ? $this->prefix . '_' . $this->tableName : $this->tableName) : '';
    }
}