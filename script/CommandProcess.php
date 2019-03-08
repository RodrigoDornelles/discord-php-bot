<?php 

class CommandProcess extends BaseScript
{
	private $lastcommand;

	function __construct()
	{
		$this->lastcommand = $_SESSION['CommandLast'];
		$this->discord = new discord();
	}

	/*
	 *	verification of new commands requested
	 */
	public function Running()
	{
		if(!self::chats()){
			return false;
		}
		foreach(self::chats() as $chat)
		{
			$msgs = $this->discord->channel->getChannelMessages(
				['channel.id'=>$chat,'limit'=>5,'after'=>$this->lastcommand[$chat]]
			);

			foreach ($msgs as $msg) {
				if($this->lastcommand[$chat] == $msg['id'])
					continue;

				$_SESSION['CommandLast'][$chat] = intval($msg['id']);
				
				foreach (self::prefixes() as $prefix) {
					if($msg['content'][0] != $prefix){
						continue;
					}
					$prefix = true;
					break;
				}
				
				if($prefix === true){

					foreach (self::controllers() as $controller) {

						$cmd = explode(" ",substr($msg['content'],1), 2);
						$params = isset($cmd[1])?$cmd[1]:'';
						$cmd = "action$cmd[0]";

						if(method_exists($controller, $cmd)){
							$process = new $controller($chat,'cmd', $msg);
							$process->$cmd($params);
							break;
						}
					}
				}
			}

		}
		return true;
	}

	public static function Controllers()
	{
		return $_SESSION['Controllers'];
	}

	/*
	 *	list of channels that can use commands
	 */
	public static function Chats()
	{
		return self::channels('cmd');
	}

	/*
	 *	begin character of a command
	 */
	public static function Prefixes()
	{
		return self::config()->get['cmd_prefix'];
	}
};
?>
