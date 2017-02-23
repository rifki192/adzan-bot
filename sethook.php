<?php
require_once "vendor/autoload.php";
require_once "config.php";

try {
    $bot = new \TelegramBot\Api\Client($token);

    print_r($bot->SetWebhook('https://bot.haynik.id/telegram/adzan/hook.php'));

} catch (\TelegramBot\Api\Exception $e) {
    echo $e->getMessage();
}