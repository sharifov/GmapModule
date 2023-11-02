<?php

namespace GmapModule\System;

use LogicException;

class Provider
{
	private static self $self;

    private function __construct()
	{
		//
	}

	/** Initialization all provider packets */
	private static function run(): void
	{
		if (empty(static::$self)) {
			static::$self = new static;
		}
	}

    /** Set provider via name */
	private static function setProvider(string $provider): void
	{
		if (!isset(static::$self->{$providerName})) {
            if (!class_exists($provider)) {
                throw new LogicException("Невозможно найти класс: $provider");
            }
			static::$self->{$provider} = new $provider;
		}
	}

    /**
     * Get provider via name
     */
	private static function getProvider(string $provider): IProvider
	{
		static::run();
		static::setProvider($provider);
		return static::$self->{$provider};
	}

    /**
     * Get provider object
     * @throws LogicException
     */
	public static function get(string $provider): IProvider
	{
		return static::getProvider($provider);
	}
}