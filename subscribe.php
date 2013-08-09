<?php
// load configuration data
$CONF = parse_ini_file('/var/www/xlerb.ini');

$CONFIRMATION_MESSAGE = <<<ENDCONFIRM
Greetings — 

You have asked to join the Xlerb.com mailing list. If you did not
request this, then please ignore this email with my apologies.  If
you did request it, please click the following link to verify your
subscription:

http://xlerb.com/subscribe.php?email=%s&verify=%s

Once you have joined the list, you can unsubscribe immediately by
clicking the link at the end of each email.

Sincerely,
Glen Campbell

ENDCONFIRM;

$WELCOME_MESSAGE = <<<ENDWELCOME
Welcome!

You've successfully joined the chat@xlerb.info mailing list.  You
can subscribe at any time by clicking the link at the bottom of any
of the list messages.

To send a message to other list members, simply direct it to
chat@xlerb.info.

Glen

ENDWELCOME;

// generate hash from email
function hashit($email) {
	global $CONF;
	return sha1( $CONF['salt'].$CONF['list'].$email );
}
// generate random shit
function fuzz() {
	return sha1( microtime() );
}

// validate request method
switch(strtoupper($_SERVER['REQUEST_METHOD'])) {
// new subscription
case 'POST':
	if (!isset($_POST['email']))
		die("Invalid request");
	$email_message = sprintf($CONFIRMATION_MESSAGE, 
		$_POST['email'], hashit($_POST['email']));
	mail(
		$_POST['email'],
		'Confirm mailing list subscription',
		$email_message,
		'From: glen@xlerb.com'
	);
	header('Location: '.$CONF['domain'].'?SUB1='.fuzz());
	exit;
	break;
// subscription verification
case 'GET':
	$string = hashit($_GET['email']);
	if (!strcmp($string, $_GET['verify'])) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$CONF['apikey']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $CONF['endpoint'].'/lists/'.	
		$CONF['list'].'/members');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
			'address' => $_GET['email'],
			'subscribed' => TRUE
		));
		$result = curl_exec($ch);
		curl_close($ch);
		if ($result === FALSE) {
			error_log('SUBERR'.print_r($result,TRUE));
			header('Location: '.$CONF['domain'].'?SUBERR='.fuzz());
		}
		else {
			mail(
				$_GET['email'],
				'Welcome to chat@xlerb.info',
				$WELCOME_MESSAGE,
				'From: glen@xlerb.com'
			);
			header('Location: '.$CONF['domain'].'?SUB2='.fuzz());
		}
	}
	else {
		header('Location: '.$CONF['domain'].'?SUBERR='.fuzz());
		exit;
	}
	break;
// anything else
default:
	header("HTTP/1.1 405 Invalid Method");
	die("Invalid Method ".$_SERVER['REQUEST_METHOD']);
}

// load config data
$conf = parse_ini_file('/etc/xlerb.ini');
