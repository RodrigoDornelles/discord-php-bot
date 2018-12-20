<?php 

include __DIR__.'/../vendor/autoload.php';
include __DIR__.'/Command.php';

use RestCord\DiscordClient;

class Script
{
	function __construct()
	{
		Command::init();

		while (true) {
			Command::main();

			sleep(Script::Config()->sleep);
		}

	}

	public function Bot()
	{
		return (object) new DiscordClient(
			['token' => Script::Config()->token]
		);
	}

	public function Config()
	{
		return (object) $_SESSION['_CONFIG'];
	}
};
?>