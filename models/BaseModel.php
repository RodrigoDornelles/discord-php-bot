<?php

use RestCord\DiscordClient;

class BaseModel
{
	function __construct($messageid = null ,$channel = null, $author = null, $mentioned = null)
	{
		if($channel){
			$_SESSION['thischat'] = $channel; 
		}
		if($author){
			$_SESSION['thisauthor'] = $author;
		}
		if($messageid){
			$_SESSION['thismsg'] = intval($messageid);
		}
		if($mentioned === true){
			$_SESSION['mentioned'] = true;
		}
		else {
			$_SESSION['mentioned'] = false;
		}

	}

	function __destruct()
	{

	}

	/*
	 *	Currently selected channel
	 */
	public function Channel()
	{
		return isset($_SESSION['thischat'])?$_SESSION['thischat']:'';
	}

	/*
	 *	Mention current user on channel
	 */
	public function Mention()
	{
		if(!isset($_SESSION['thisauthor']))
			return null;

		$author = $_SESSION['thisauthor'];
		return "<@$author>";
	}

	/*
	 *	mention all users
	 */
	public function Everyone()
	{
		return "<@525842470223872000>";
	}

	public function Mentioned()
	{
		return isset($_SESSION['mentioned'])?$_SESSION['mentioned']:false;
	}


	public function Message()
	{
		return isset($_SESSION['thismsg'])?$_SESSION['thismsg']:false;
	}

	/*
	 *
	 */
	public function MyId()
	{
		return isset($_SESSION['myid'])?$_SESSION['myid']:'';
	}

	/*
	 *	convert number to string emoji
	 */
	public function strnumber($value)
	{
		switch ($value)
		{
			case 1: return ':one:';case 2: return ':two:';case 3: return ':three:';
			case 4: return ':four:';case 5: return ':five:';case 6: return ':six:';
			case 7: return ':seven:';case 8: return ':eight:';case 9: return ':nine:';
		}
		return null;
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
	 *
	 */
	public function init()
	{
		$bot = BaseModel::Bot()->user->getCurrentUser();
		
		$_SESSION['myid'] = $bot->id;
		$_SESSION['myimg'] = $bot->avatar;
	}

	public function actionHelp($author, $params)
	{
		if(!BaseModel::Mentioned())
			return true;

		$cmds = get_class_methods(new CommandController);
		$message = Message::Template('cmdlist');

		foreach ($cmds as $cmd) {
			if(strpos($cmd, "action") !== false){
				$cmd = substr($cmd,6);
    			$message .= " `$cmd`";
    		}
		}

		return Message::Send(['content' => $message]);
	}

}

?>