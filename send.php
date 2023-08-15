<?php
require_once __DIR__ . '/auth.php';

header("Expires: " . gmdate("D, d M Y H:i:s", 0) . " GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$body = $_POST['body'];

$to = $_POST['to'];
$to = explode(';', $to);

$cc = $_POST['cc'];
if ($cc !== '')
    $cc = explode(';', $cc);
else
    $cc = [];

$bcc = $_POST['bcc'];
if ($bcc !== '')
    $bcc = explode(';', $bcc);
else
    $bcc = [];

$subject = $_POST['subject'];

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Crypto\DkimSigner;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;

$transport = Transport::fromDsn("smtps://$servUser:$servPass@$servServ:465");
$mailer = new Mailer($transport);

$signer = new DkimSigner(SECKEY[$userDom]['key'], $userDom, SECKEY[$userDom]['selector']);

$email = (new Email())
    ->from($rawUser)
    ->subject($subject)
    ->text($body);

foreach ($to as $t) {
    $email->addTo($t);
}

foreach ($cc as $c) {
    $email->addCc($c);
}

foreach ($bcc as $b) {
    $email->addBcc($b);
}

$signedEmail = $signer->sign($email);

$result = $mailer->send($signedEmail);

echo $result;
?>
Done.