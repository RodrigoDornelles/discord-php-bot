<?php 

use RestCord\DiscordClient;

class CommandController extends BaseModel
{
	public function actionHelloWorld($author, $channel, $params)
	{
		$this->Message(['content' => 'Hello World']);
	}

	public function actionBig($author, $channel, $params)
	{
		if(!strlen($params)){
			return $this->Message(['content' => $this->Mention()." insira um texto após o comando!"]);
		}

		$params = str_split(strtolower($params));

		foreach ($params as $char) {

			if($char == " "){
				$message .= " \t\t ";
			}

			if(!preg_match("/^([a-z-0-9]+)$/i",$char))
				continue;
		
			if(is_numeric($char)){
				$message .= $this->strnumber($char);	
			}
			else{
				$message .= ":regional_indicator_$char:";
			}
		}
		return $this->Message(['content' => $message]);
	}
};
?>
