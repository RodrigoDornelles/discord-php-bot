<?php

include __DIR__.'/vendor/autoload.php';

use RestCord\DiscordClient;

$discord = new DiscordClient(['token' => 'NTI0NDIxMjU2NTgyNTI5MDI0.Dvn1FA.9E17nmuoh__sy4VN9rdCt-7U--E']); 

?>

<?

var_dump($discord->channel->createMessage(['channel.id' => 432719722899832834, 'content' => 'Foo Bar Baz']));

echo "feito!";

/*
ls/432719722899832834/messages POST /api/v6/channels/432719722899832834/messages HTTP/1.1 Content-Length: 37 Authorization: Bot <TOKEN> User-Agent: DiscordBot (https://github.com/aequasi/php-restcord, 0.1.1) Host: discordapp.com Content-Type: application/json  {"content":"Foo Bar Baz","tts":false} [] []
[2018-12-18 03:18:28] Logger.INFO: HTTP/1.1 400 BAD REQUEST Date: Tue, 18 Dec 2018 03:18:28 GMT Content-Type: application/json Content-Length: 42 Connection: close Set-Cookie: __cfduid=d69c3e5daa4fb178280b26f3420731fdb1545103108; expires=Wed, 18-Dec-19 03:18:28 GMT; path=/; domain=.discordapp.com; HttpOnly Strict-Transport-Security: max-age=31536000; includeSubDomains X-RateLimit-Limit: 5 X-RateLimit-Remaining: 4 X-RateLimit-Reset: 1545103114 Via: 1.1 google Alt-Svc: clear Expect-CT: max-age=604800, report-uri="https://report-uri.cloudflare.com/cdn-cgi/beacon/expect-ct" Server: cloudflare CF-RAY: 48ae7b7c1a9b4a36-GRU  {"code": 40001, "message": "Unauthorized"} [] []
PHP Fatal error:  Uncaught GuzzleHttp\Exception\ClientException: Client error: `POST https://discordapp.com/api/v6/channels/432719722899832834/messages` resulted in a `400 BAD REQUEST` response:

 in /home/rodrigo/public_html/discord_cf/vendor/guzzlehttp/guzzle/src/Exception/RequestException.php:113
Stack trace:
#0 /home/rodrigo/public_html/discord_cf/vendor/guzzlehttp/guzzle/src/Middleware.php(66): GuzzleHttp\Exception\RequestException::create(Object(GuzzleHttp\Psr7\Request), Object(GuzzleHttp\Psr7\Response))
#1 /home/rodrigo/public_html/discord_cf/vendor/guzzlehttp/promises/src/Promise.php(203): GuzzleHttp\Middleware::GuzzleHttp\{closure}(Object(GuzzleHttp\Psr7\Response))
#2 /home/rodrigo/public_html/discord_cf/vendor/guzzlehttp/promises/src/Promise.php(156): GuzzleHttp\Promise\Promise::callHandler(1, Object(GuzzleHttp\Psr7\Response), Array)
#3 /home/rodrigo/public_html/discord_cf/vendor/guzzlehttp/promises/src/TaskQueue.php(47): GuzzleHttp\Promise\Promise::GuzzleHttp\Promise\{closure}()
#4 /home/rodrigo/public_html/discord_ in /home/rodrigo/public_html/discord_cf/vendor/guzzlehttp/command/src/Exception/CommandException.php on line 57
*/