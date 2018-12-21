<?php 

include __DIR__.'/../vendor/autoload.php';
include __DIR__.'/Command.php';

use RestCord\DiscordClient;

class Script
{
	/*
	 *	runs bot discord application
	 */
	function __construct()
	{
		exec("ping discord.gg -c 1", $result);

		/* possible execution verifications */
		if(strlen(Script::Config()->token) < 23 ){
			die(Script::Print('error').Script::Print('notoken'));
		} 
				
		if(!count($result)){
			print(Script::Print('error'));
			die(exec("ping discord.gg -c 1")."\n\n");
		}

		if(!count(Script::Channel('cmd')) &&  !count(Script::Channel('chats'))){
			die(Script::Print('error').Script::Print('nochats'));
		}

		foreach (Script::Config()->channels as $channelType) {
			foreach ($channelType as $chat) {
				if(is_string($chat) || !is_numeric($chat)){
					die(Script::Print('error').Script::Print('invalidchat'));
				}	
			}			
		}

		/* configuration of the application modules */
		Command::init();

		Print(Script::Print('ok').Script::Print('started'));
		for($i=0; $i < Script::Config()->get['startin']; $i++ ){
			sleep(print('.'));
		}

		/* operation of the application */
		while (true) {
			Command::main();

			Print(Script::Print('running'));
			sleep(Script::Sleep());
		}

	}

	/*
	 *	template console message
	 */
	public function Print($message)
	{
		return Script::Config()->messages['console'][$message];
	}

	/*
	 *	run bot discord api
	 */
	public function Bot()
	{
		return (object) new DiscordClient(
			['token' => Script::Config()->token]
		);
	}

	/*
	 *	list of interactive channels
	 */
	public function Channel($channel)
	{
		return Script::Config()->channels[$channel];
	}

	/*
	 *	idle time until next thread
	 */
	public function Sleep()
	{
		return Script::Config()->get['sleep'];
	}

	/*
	 *	configuration loaded in the application
	 */
	public function Config()
	{
		return (object) $_SESSION['_CONFIG'];
	}
};
?>