<?php

namespace GmapModule\Database;

use GmapModule\System\IProvider;

interface IDatabase extends IProvider
{
	/**
	* Insert data
	* @param string[] $options
	*/
	public function insert(array $options = []): bool;

	/**
	* Update data
	* @param string[] $where
	* @param string[] $options
	*/
	public function update(array $where, array $options = []): bool;

	/** Delete data */
	public function delete(int $id): bool;

    /** Set active table */
    public function setTable(string $tableName): void;
}