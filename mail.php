<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';

// можно несколько адресов, через запятую


$admin_email  = ['quiz24-job@yandex.ru'];
$form_subject = trim($_POST["Тема"]);

$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';



$c = true;
$message = '';
$message2 = '';
foreach ( $_POST as $key => $value ) {
	if ( $value != ""  && $key != "admin_email" && $key != "form_subject" ) {
		if (is_array($value)) {
			$val_text = '';
			foreach ($value as $val) {
				if ($val && $val != '') {
					$val_text .= ($val_text==''?'':', ').$val;
				}
			}
			$value = $val_text;
		}
		$message2 .= "{$key}: {$value} \n";

		$message .= "
		" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
		<td style='padding: 10px; width: auto;'><b>$key:</b></td>
		<td style='padding: 10px;width: 100%;'>$value</td>
		</tr>
		";

	}
}
$message = "<table style='width: 50%;'>$message</table>";

$phone = $_POST['Телефон'];

// От кого
$mail->setFrom('info@' . $_SERVER['HTTP_HOST'], 'Атлас ');

// Кому
foreach ( $admin_email as $key => $value ) {
	$mail->addAddress($value);
}

// Тема письма
$mail->Subject = $form_subject;

// Тело письма
$body = $message;
// $mail->isHTML(true);  это если прям верстка
$mail->msgHTML($body);

$mail->send();

require_once ('query/index.php');

return true;