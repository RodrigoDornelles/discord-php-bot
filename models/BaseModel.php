<?php

use RestCord\DiscordClient;

class BaseModel
{
	function __construct($channel = null, $author = null)
	{
		if($channel){
			$_SESSION['thischat'] = $channel;
		}
		if($author){
			$_SESSION['thisauthor'] = $author;
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

	/*
	 *	Send message to channel
	 */
	public function Message($params)
	{
		$params = array_merge(
			['channel.id'=> BaseModel::Channel()],
			$params
		);
		return Script::Bot()->channel->createMessage($params);
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
}

?>