<?php
require_once "vendor/autoload.php";
require_once "config.php";

try {
    $bot = new \TelegramBot\Api\Client($token);

    $bot->command('start', function ($message) use ($bot) {
        $answer =  "Hai, terimakasih telah menggunakan Adzan Bot, sudahkah anda shalat ? \n/jadwal -> untuk melihat jadwal shalat hari ini \n/ubahkota -> untuk mengubah lokasi kota jadwal ";
        $answer = str_replace('\n', chr(10), $answer);
        $bot->sendMessage($message->getChat()->getId(), $answer);
    });
    $bot->command('jadwal', function ($message) use ($bot) {
        $answer = "Jadwal Shalat untuk Bandung hari ini :\n";
        $jadwal = json_decode(file_get_contents('http://muslimsalat.com/bandung/daily.json'));
        $answer .= "Subuh   : " . $jadwal->items[0]->fajr . "       ";
        $answer .= "Terbit  : " . $jadwal->items[0]->shurooq . "\n";
        $answer .= "Dzuhur  : " . $jadwal->items[0]->dhuhr . "      ";
        $answer .= "Ashar   : " . $jadwal->items[0]->asr . "\n";
        $answer .= "Maghrib : " . $jadwal->items[0]->maghrib . "       ";
        $answer .= "Isya    : " . $jadwal->items[0]->isha;
        $answer = str_replace('\n', chr(10), $answer);
        $answer = str_replace('\t', chr(11), $answer);
        $bot->sendMessage($message->getChat()->getId(), $answer);
    });
    $bot->command('ubahkota', function ($message) use ($bot) {
        $answer = "Saat ini hanya mendukung kota Bandung, fitur ini belum tersedia";
        $bot->sendMessage($message->getChat()->getId(), $answer);
    });

    $bot->run();

} catch (\TelegramBot\Api\Exception $e) {
    $e->getMessage();
}