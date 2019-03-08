<?php 

use RestCord\DiscordClient;
/**
 * 
 */
class Discord extends BaseScript
{
	function __construct()
	{
		$this->discord = new DiscordClient([
			'token' => self::config()->token
		]);
	}

	public function __get($name)
	{
		return $this->discord->__get($name);
	}
}

?>