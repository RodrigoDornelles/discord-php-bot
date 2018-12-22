<?php 

use RestCord\DiscordClient;

class Command extends BaseModel
{
	/*
	 * stores the last command of each chat to ignore
	 */
	public function init()
	{
		foreach(Command::Chats() as $chat)
		{
			$msg = Script::Bot()->channel->getChannelMessages(['channel.id'=>$chat, 'limit'=>1]);
			$_SESSION['CommandLast'][$chat] = intval($msg[0]['id']);
		}	
	}
	/*
	 *	verification of new commands requested
	 */
	public function main()
	{
		$lastcommand = $_SESSION['CommandLast'];

		foreach(Command::Chats() as $chat)
		{
			$msgs = Script::Bot()->channel->getChannelMessages(
				['channel.id'=>$chat,'limit'=>5,'after'=>$lastcommand[$chat]]
			);

			foreach ($msgs as $msg) {
				if($lastcommand[$chat] == $msg['id'])
					continue;

				$_SESSION['CommandLast'][$chat] = intval($msg['id']);
				
				foreach (Command::Prefix() as $prefix) {
					if($msg['content'][0] != $prefix){
						continue;
					}
					$prefix = true;
					break;
				}

				if($prefix === true){
					$cmd = explode(" ",substr($msg['content'],1), 2);
					$params = isset($cmd[1])?$cmd[1]:'';
					$cmd = "action$cmd[0]";

					$author = $msg['author'];

					if(is_callable('CommandController', $cmd[0])){
						$process = new CommandController($chat,$author['id']);
						$process->$cmd($author,$chat,$params);
					}
				}
			}

		}

	}
	/*
	 *	list of channels that can use commands
	 */
	public function Chats()
	{
		return Script::Channels('cmd');
	}

	/*
	 *	begin character of a command
	 */
	public function Prefix()
	{
		return Script::Config()->get['cmd_prefix'];
	}
};
?>
