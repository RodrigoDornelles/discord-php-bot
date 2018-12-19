<?php

namespace models;

class Philosopher
{
	public $phrases = require __DIR__.'../src/phrases_pt.php';

	/*
	 *	returns a random phrase from a thinker
	 */
	public function getRandomPhrase($philosopher = null)
	{
		if(!$philosopher){
			$philosopher = Philosopher::getRandomPhilosopher();
		}

		$phrase= $phrases[$philosopher];
		unset($phrases);

		return Philosopher::getPhrase($philosopher,rand(0, sizeof($phrase)));
	}

	/*
	 *	returns a specific phrase
	 */
	public function getPhrase($philosopher, $phraseid)
	{
		$phrase = $phrases[$phraseid];
		return $phrase[$phraseid];
	}

	/*
	 *	returns a random thinker
	 */
	public function getRandomPhilosopher()
	{
		$philosophers = $phrases;

		$c = count($philosophers);
		$r = rand(0, $phrases);

		for($i=0;$i<$c;$i++){
		    
		    if($i == $r){ 
		    	return key($philosophers);
		    }
		    next($philosophers);  
		}
		return null;
	}
}
   