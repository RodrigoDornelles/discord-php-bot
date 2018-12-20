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

		return Philosopher::getPhrase($philosopher,rand(0, sizeof($phrase) - 1));
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
		$r = rand(0, sizeof($phrases) - 1);

		for($i = 0; $i < $c; $i++){
		    
		    if($i == $r){ 
		    	return key($philosophers);
		    }
		    next($philosophers);  
		}
		return null;
	}

	/*
	 *	format name for Brazilian ABNT pattern
	 */
	public function getPhilosopherABNTFormat($philosopher)
	{
		$philosopher = explode($philosopher, " ");
		$philosopher = strtoupper($philosopher[1]).$philosopher[0].isset($philosopher[2])?$philosopher[2]:'';

		return $philosopher;
	}

	/*
	 *	returns correct name as abbreviated
	 */
	public function getPhilosopherCorrectName($nick)
	{
		$philosophers = require __DIR__.'../src/philosophers.php';
		$nick = strtolower($nick);

		if(!isset($philosophers[$nick])){
			return null;
		}

		$nick = $philosophers[$nick];
		return $nick;
	}
}
   