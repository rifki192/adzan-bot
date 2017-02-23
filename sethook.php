<?php
require_once "vendor/autoload.php";
require_once "config.php";

try {
    $bot = new \TelegramBot\Api\Client($token);

    print_r($bot->SetWebhook('HOOK_URL'));

} catch (\TelegramBot\Api\Exception $e) {
    echo $e->getMessage();
}