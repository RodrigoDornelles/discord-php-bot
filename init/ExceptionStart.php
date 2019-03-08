<?php

/**
 * 
 */
class ExceptionStart extends BaseScript
{
	public static function Validator()
	{
		exec("ping discord.gg -c 1", $result);

		/* possible execution verifications */
		if(strlen(self::config()->token) < 23 ){
			throw new Exception(self::label('notoken'));
		} 
				
		if(!count($result)){
			throw new Exception(exec("ping discord.gg -c 1")."\n\n");
		}

		if(!count(self::channels('cmd')) &&  !count(self::channels('chats'))){
			throw new Exception(self::label('nochats'));
		}

		foreach (self::config()->channels as $channelType) {
			foreach ($channelType as $chat) {
				if(is_string($chat) || !is_numeric($chat)){
					throw new Exception(self::label('invalidchat'));
				}	
			}			
		}
	}
}
?>