<?php

require_once(__DIR__ . '/../autoload.php');

$MessageBird = new \MessageBird\Client('YOUR_ACCESS_KEY'); // Set your own API access key here.

$VoiceMessage             = new \MessageBird\Objects\VoiceMessage();
$VoiceMessage->recipients = array (31654286496);
$VoiceMessage->body = 'This is a test message. The message is converted to speech and the recipient is called on his mobile.';
$VoiceMessage->language = 'en-gb';
$VoiceMessage->voice = 'female';
$VoiceMessage->ifMachine = 'continue'; // We don't care if it is a machine.

try {
    $VoiceMessageResult = $MessageBird->voicemessages->create($VoiceMessage);
    var_dump($VoiceMessageResult);

} catch (\MessageBird\Exceptions\AuthenticateException $e) {
    // That means that your accessKey is unknown
    echo 'wrong login';

} catch (\MessageBird\Exceptions\BalanceException $e) {
    // That means that you are out of credits, so do something about it.
    echo 'no balance';

} catch (\Exception $e) {
    echo $e->getMessage();
}
