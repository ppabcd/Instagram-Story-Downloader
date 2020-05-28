<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/lib/config.php';

use InstagramAPI\Exception\ChallengeRequiredException;
use \InstagramAPI\Instagram;

$verification_method = 0; 	//0 = SMS, 1 = Email


class ExtendedInstagram extends Instagram {
	public function changeUser( $username, $password ) {
		$this->_setUser( $username, $password );
	}
}

function readln( $prompt ) {
	if ( PHP_OS === 'WINNT' ) {
		echo "$prompt ";

		return trim( (string) stream_get_line( STDIN, 6, "\n" ) );
	}

	return trim( (string) readline( "$prompt " ) );
}

$ig = new ExtendedInstagram();

try {
	$loginResponse = $ig->login( $username, $password );
	echo 'Logged in!';
} catch ( Exception $exception ) {

	$response = $exception->getResponse();

	if ($exception instanceof ChallengeRequiredException
	&& $response->getErrorType() === 'checkpoint_challenge_required') {

		sleep(3);

		$checkApiPath = substr( $response->getChallenge()->getApiPath(), 1);
		$customResponse = $ig->request($checkApiPath)
									->setNeedsAuth(false)
									->addPost('choice', $verification_method)
									->addPost('_uuid', $ig->uuid)
									->addPost('guid', $ig->uuid)
									->addPost('device_id', $ig->device_id)
									->addPost('_uid', $ig->account_id)
									->addPost('_csrftoken', $ig->client->getToken())
									->getDecodedResponse();

	} else {
		echo "Not a challenge required exception...\n";
		exit;
	}

	try {

		if ($customResponse['status'] === 'ok' && $customResponse['action'] === 'close') {
			echo 'Checkpoint bypassed';
                        exit();
		}

		$code = readln( 'Code that you received via ' . ( $verification_method ? 'email' : 'sms' ) . ':' );
		$ig->changeUser( $username, $password );
		$customResponse = $ig->request($checkApiPath)
									->setNeedsAuth(false)
									->addPost('security_code', $code)
									->addPost('_uuid', $ig->uuid)
									->addPost('guid', $ig->uuid)
									->addPost('device_id', $ig->device_id)
									->addPost('_uid', $ig->account_id)
									->addPost('_csrftoken', $ig->client->getToken())
									->getDecodedResponse();

		if ($customResponse['status'] === 'ok' && (int) $customResponse['logged_in_user']['pk'] === (int) $user_id ) {
			echo 'Finished, logged in successfully! Run this file again to validate that it works.';
		} else {
			echo "Probably finished...\n";
			var_dump( $customResponse );
		}
	} catch ( Exception $ex ) {
		echo $ex->getMessage();
	}
}