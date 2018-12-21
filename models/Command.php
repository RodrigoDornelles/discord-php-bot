<?php 

include __DIR__.'/../vendor/autoload.php';

use RestCord\DiscordClient;


class Command
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
					Command::action($chat, $cmd[0], $cmd[1]);
				}
			}

		}

	}
	private function action($chat, $cmd, $params = null)
	{
		$msg = "Olá Rodrigo! \n\nrecebi seu comando.```PHP\n#CMD:\n $cmd\n#PARAMS:\n $params```";
		Script::Bot()->channel->createMessage(['channel.id' => $chat, 'content' => $msg]);
	}

	public function Chats()
	{
		return Script::Channel('cmd');
	}

	public function Prefix()
	{
		return Script::Config()->get['cmd_prefix'];
	}
};
?>