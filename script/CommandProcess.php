<?php 

define('ALIAS_NAMES', 0);
define('ALIAS_ACTION', 1);
define('CMD', 0);
define('PARAM', 1);


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
						$params = isset($cmd[PARAM])?$cmd[PARAM]:'';

						$process = new $controller($chat,$cmd[CMD],$msg);

						if(self::CommandAlias($controller, $process, $cmd[CMD], $params)){
							return true;
						}

						$cmd = "action{$cmd[0]}";

						if(method_exists($controller, $cmd)){							
							$process->$cmd($params);
							return true;
						}
					}
				}
			}

		}
		return true;
	}

	public static function CommandAlias($controller, $process, $oldcmd, $params)
	{
		if(!$process->alias()){
			return false;
		}

		foreach ($process->alias() as $aliasGroup) {


			foreach ($aliasGroup[ALIAS_NAMES] as $alias) {

				if(strtolower($oldcmd) != strtolower($alias)){
					continue;	
				}

				$newcmd = "action{$aliasGroup[ALIAS_ACTION]}";
				if(method_exists($controller, $newcmd)){							
					$process->$newcmd($params);
				 	return true;
				}			
			}
		}
		return false;
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
