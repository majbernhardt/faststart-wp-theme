<?php
// Подписчики с формы подписки
/*
     * SendPulse REST API Usage Example
     *
     * Documentation
     * https://login.sendpulse.com/manual/rest-api/
     * https://sendpulse.com/api
*/
require_once( 'api/sendpulseInterface.php' );
require_once( 'api/sendpulse.php' );
// https://login.sendpulse.com/settings/#api
define( 'API_USER_ID', 'Сюда userID' );
define( 'API_SECRET', 'Сюда SECRET_KEY)' );
define( 'TOKEN_STORAGE', 'file' );
$SPApiProxy = new SendpulseApi( API_USER_ID, API_SECRET, TOKEN_STORAGE );
// Получаем информацию об адресной книге по ID книги
$responseEmail = $_REQUEST['subscribeEmail']; // Name поля в форме
//  Книга "Форма подписки на рассылку"
$addressbookId = 000000; // ID Книги из sendpulse
//	Собираем email для адресной книги
$emails = [
	[
		'email' => $responseEmail,
	]
];
// Добавляем контакты в адресную книгу
$SendEmailsInBook = $SPApiProxy->addEmails($addressbookId, $emails); 
?>