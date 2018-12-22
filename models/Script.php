<?php 

use RestCord\DiscordClient;

class Script extends BaseModel
{
	/*
	 *	runs bot discord application
	 */
	public function run()
	{
		Print(Script::Print('starting'));
		exec("ping discord.gg -c 1", $result);

		/* possible execution verifications */
		if(strlen(Script::Config()->token) < 23 ){
			die(Script::Print('error').Script::Print('notoken'));
		} 
				
		if(!count($result)){
			print(Script::Print('error'));
			die(exec("ping discord.gg -c 1")."\n\n");
		}

		if(!count(Script::Channels('cmd')) &&  !count(Script::Channels('chats'))){
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
	 *	list of interactive channels
	 */
	public function Channels($channel)
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