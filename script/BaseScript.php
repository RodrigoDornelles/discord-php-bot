<?php 

/**
 * 
 */
class BaseScript
{
	protected $discord;

	function __construct()
	{
		$discord = new discord();
	}
	/*
	 *	template console message
	 */
	public static function Label($message)
	{
		return self::config()->messages['console'][$message];
	}

	/*
	 *	list of interactive channels
	 */
	public static function Channels($channel)
	{
		return self::config()->channels[$channel];
	}

	/*
	 *	idle time until next thread
	 */
	public static function Sleep()
	{
		return self::config()->get['sleep'];
	}

	/*
	 *	configuration loaded in the application
	 */
	public static function Config()
	{
		return (object) $_SESSION['_CONFIG'];
	}
}

?>