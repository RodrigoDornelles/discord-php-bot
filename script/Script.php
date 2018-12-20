<?php 

include __DIR__.'/../vendor/autoload.php';

use RestCord\DiscordClient;

class Script
{
	public $_BOT;

	function __construct()
	{
		$_BOT = new DiscordClient(
			['token' => Script::Config()->token]
		); 
	}

	public function Bot()
	{
		return $_BOT;
	}

	public function Config()
	{
		return (object) $_SESSION['_CONFIG'];
	}
};
?>