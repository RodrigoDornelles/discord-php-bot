<?php
class CommandInit extends CommandProcess
{
	
	public static function Start()
	{
		self::loadChats();
		self::loadControllers();
	}

	/*
	 * stores the last command of each chat to ignore
	 */
	private static function LoadChats()
	{
		$_SESSION['CommandLast'] = null;

		foreach(self::chats() as $chat)
		{
			$discord = new discord();

			$msg = $discord->channel->getChannelMessages([
				'channel.id'=>$chat, 'limit'=>1
			]);

			$_SESSION['CommandLast'][$chat] = intval($msg[0]['id']);
		}
	}

	private static function LoadControllers()
	{
		$files = scandir('controllers');
		$controllers = null;

		foreach ($files as $file)
		{
		    if(strpos($file, 'Controller.php') === false){
		        continue;
		    }
		    $controllers[] = str_replace('.php', '', $file);
		}
		$_SESSION['Controllers'] = $controllers;
	}
};
?>

