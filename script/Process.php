<?php 

/**
 * 
 */
class Process extends BaseScript
{
	public static function Running()
	{
		/* operation of the application */
		while (true) {

			$exe = new CommandProcess();
			$exe->running();

			Print(self::label('running'));
			sleep(self::sleep());
		}
	}	
}

