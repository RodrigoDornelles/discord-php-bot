<?php 


class CommandController extends BaseController
{

	public function alias()
	{
		return [
			[['hello', 'ola'], 'helloWorld'],
			[['bueno', 'hw'], 'helloWorld'],
			[['alias', 'test'], 'testAlias']
		];
	}

	public function actionTestAlias()
	{
		return $this->sendMenssage("`/{$this->action}` Sinonimo para: `/TestAlias`");
	}

	public function actionHelloWorld()
	{
		var_dump(self::alias());
		return $this->sendMenssage('Hello World');
	}

	
	public function actionBig($params)
	{
		if(!strlen($params)){
			return $this->sendMenssage($this->mention." insira um texto após o comando!");
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
		return $this->sendMenssage($message);
	}

	public function actionSentidoDaVida()
	{
		return $this->sendMenssage($this->mention."\n**[ RESPOSTA ]** :four: :two:");
	}
	/*
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
	}*/
};
?>
