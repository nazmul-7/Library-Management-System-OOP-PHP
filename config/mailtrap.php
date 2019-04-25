<?php
if ($_SERVER['SERVER_NAME'] == 'localhost') {
  $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
      ->setUsername('66f4e0146c6841')
      ->setPassword('b51bada197902b');
} else {
  $transport = new Swift_SendmailTransport();
}

$mailer = new Swift_Mailer($transport);