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
		$mention = false;

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

				if(count($msg['mentions'])){
					foreach ($msg['mentions'] as $mention) {
						if($mention['id'] != BaseModel::MyId()){
							continue;
						}
						$mention = true;
						break;
					}
				}

				if($prefix !== true)
					continue;
	
				$cmd = explode(" ",substr($msg['content'],1), 2);
				$params = isset($cmd[1])?$cmd[1]:'';
				$cmd = "action$cmd[0]";

				$author = $msg['author'];


				if(method_exists('CommandController', $cmd)){
					$process = new CommandController($msg['id'],$chat,$author['id'], $mention);
					$process->$cmd($author,$params);
				}
				else if($mention === true){
					BaseModel::Message([
						'content'=> Message::Template('cmdinvalid'),
						'channel.id'=>$chat
					]);
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
