<?php 

/**
 * 
 */
class Start extends BaseScript
{
	
	public static function Now()
	{
		Print(self::label('starting'));
		
		/* validation for startup */
		try {
			ExceptionStart::validator();
		} catch (Exception $e) {
			die("{$e->getMessage()}\n\n");
		}


		/* countdown to run bot */
		Print(self::label('ok').self::label('started'));
		for($i=0; $i < self::config()->get['startin']; $i++ ){
			sleep(print('.'));
		}

		Start::myInfos();
		CommandInit::start();

		Process::running();
	}
	
	public function MyInfos()
	{
		$discord = new discord();
		$bot = $discord->user->getCurrentUser();		
		
		$_SESSION['myid'] = $bot->id;
		$_SESSION['myimg'] = $bot->avatar;
	}
}
?>