<?php 

use RestCord\DiscordClient;

class CommandController extends BaseModel
{
	public function actionHelloWorld($author, $params)
	{
		return Message::Send(['content' => 'Hello World']);
	}

	public function actionBig($author, $params)
	{
		if(!strlen($params)){
			return Message::Send(['content' => $this->Mention()." insira um texto após o comando!"]);
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
		return Message::Send(['content' => $message]);
	}

	public function actionMaisGay($author, $params)
	{
		$message = Script::Bot()->channel->getChannelMessage([
			'channel.id'=>$this->Channel(),
			'message.id'=>$this->Message()
		]);

		if(count($message['mentions']) < 2){
			return Message::Send(['content' => $this->Mention().
				" preciso saber os nomes dos **boy magia** querido!"]);
		}

		foreach ($message['mentions'] as $mention) {
			if($mention['id'] > $viadagem){
				$viadagem = $mention['id'];	
			}				
		}

		if($author['id'] >= $viadagem){
			return Message::Send(['content' => $this->Mention()." Você é muito mais gay, do que esses caras!"]);
		}

		return Message::Send(['content' => $this->Mention()."\n**[ ATENÇÃO ]** temos um viadão: <@$viadagem>"]);
	}

	public function actionSentidoDaVida($author, $params)
	{
		return Message::Send(['content' => $this->Mention()."\n**[ RESPOSTA ]** :four: :two:"]);
	}

};
?>
