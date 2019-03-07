<?php

/**
 * 
 */
class Message extends BaseModel
{
	/*
	 *	Send message to channel
	 */
	public function Send($params)
	{
		$params = array_merge(
			['channel.id'=> BaseModel::Channel()],
			$params
		);
		return Script::Bot()->channel->createMessage($params);
	}

	public function Template($message)
	{
		return Script::Config()->messages['template'][$message];
	}	

}



?>