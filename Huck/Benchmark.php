<?php

/**
 * Gets the time it took to execute a script
 *
 * @package Laravel
 * @author Taylor Otwell
 * @link https://github.com/laravel/laravel/blob/master/laravel/benchmark.php
 * 
 */
class Huck_Benchmark {

	/**
	 * All of the benchmark starting times.
	 *
	 * @var array
	 */
	protected static $marks = array();

	/**
	 * Start a benchmark starting time.
	 *
	 * @param  string  $name
	 * @return void
	 */
	public static function start($name)
	{
		static::$marks[$name] = microtime(true);
	}

	/**
	 * Get the elapsed time in milliseconds since starting a benchmark.
	 *
	 * @param  string  $name
	 * @return float
	 */
	public static function check($name)
	{
		if (array_key_exists($name, static::$marks))
		{
			return microtime(true) - static::$marks[$name];
		}

		return (float) 0.0;
	}

	/**
	 * Get the total memory usage in megabytes.
	 *
	 * @return float
	 */
	public static function memory()
	{
		return (float) number_format(memory_get_usage() / 1024 / 1024, 2);
	}

}
