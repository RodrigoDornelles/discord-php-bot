<?php return [
	'get' => [
		'sleep' => 1,
		'startin'=> 3,
		'cmd_prefix' => ['!','/','+']
	],
	'channels' => [
		'cmd' => [410774259112345601],
		'chats' => []
	],	
	'messages'=> [
		'console'=>[
			'error'=> "\e[1;37;41m[BOT ERROR]\e[0m ",
			'ok'=> "\e[1;37;42m[OK]\e[0m ",
			'running'=> "\e[1;37;46m[BOT RUNNING]\e[0m\n\n",
			'notoken'=> "the bot token id was not configured!\n\n",
			'invalidchat'=> "chat channels setting invalidates (array with integers only)\n\n",
			'nochats'=> "please choose chats to interact: \e[0;32;40m'config/main.php'\e[0m\n\n",
			'started'=> "bot started successfully\n\n"
		]
	]
];