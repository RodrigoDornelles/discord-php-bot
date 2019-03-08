<?php 



class BaseController extends BaseScript
{
	/*
	 *	id of the original command (can be alias)
	 */
	public $action; // (string)

	/*
	 *	who called the command
	 */ 
	public $author; // (object)

	/*
	 * message containing command
	 */
	public $message; // (object)

	/*
	 *	guild that executed the command
	 */
	public $channel; // (integer)

	/*
	 *	
	 */
	public $discord;

	/*
	 *
	 */
	public $mention;

	public $everyone = "<@525842470223872000>";

	public function alias()
	{
		return null;
	}


	function __construct($channel = null, $action = null, $message = null)
	{
		if($channel && $action && $message){
			$this->discord = new discord();
			$this->action = $action;
			$this->channel = $channel;

			$this->message = (object) $message;
			$this->author = $message['author'];

			$this->mention = "<@{$this->author['id']}>";
		}
	}

	public function SendMenssage($content, $parameters = [])
	{
		if(isset($parameters['channel'])){
			$this->channel = $parameters['channel'];
		}

		$default = [
			'content' => $content,
			'channel.id' => intval($this->channel)
		];

		$parameters = array_merge($default, $parameters);
		
		var_dump($parameters);

		$this->discord->channel->createMessage($parameters);

		return true;//will return to the message in the future
	}

	public function actionHelp($parameters)
	{
		//if(!BaseModel::Mentioned())
		//	return true;

		$message = self::label('cmdlist');
		foreach (CommandProcess::controllers() as $controller) {

			$cmds = get_class_methods(new $controller());

			$message .= "\n**$controller**\n";
			foreach ($cmds as $cmd) {
				if(strpos($cmd, "action") !== false){
					$cmd = substr($cmd,6);
	    			$message .= " `$cmd`";
	    		}
			}
		}
		return $this->sendMenssage($message);		
	}
};
?>
