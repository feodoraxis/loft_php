<?php
require '../vendor/autoload.php';

$from = 'smorodin-2@yandex.ru';

$smtp = new Swift_SmtpTransport('smtp.yandex.ru', 465, 'ssl');
$transport = $smtp
                ->setUsername( $from )
                ->setPassword('Какой-то пароль');

$mailer = new Swift_Mailer($transport);

$message = (new Swift_Message('Wonderful Subject'))
                ->setFrom([$from => 'Андрей Смородин'])
                ->setTo(['info@feodoraxis.ru'])
                ->setBody('Некоторое сообщение');

try {
    $result = $mailer->send($message);
    echo 'sended';
} catch (Exception $e) {
    var_dump($e);
    echo '<pre>', print_r($e->getTrace(), true);
}