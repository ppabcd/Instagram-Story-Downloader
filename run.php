<?php

use InstagramAPI\Exception\ChallengeRequiredException;
use InstagramAPI\Instagram;

require("lib/config.php");
require("lib/functions.php");
require('lib/cli.php');

$verification_method = 1;    //0 = SMS, 1 = Email


$connection = [
    'storage' => 'mysql',
    'dbhost' => $db['host'],
    'dbname' => $db['dbname'],
    'dbusername' => $db['user'],
    'dbpassword' => $db['pass'],
];
if (!$saveToDB) {
    $connection = [];
}

class ExtendedInstagram extends Instagram
{
    public function changeUser($username, $password)
    {
        $this->_setUser($username, $password);
    }
}

function readln($prompt)
{
    if (PHP_OS === 'WINNT') {
        echo "$prompt ";

        return trim((string)stream_get_line(STDIN, 6, "\n"));
    }

    return trim((string)readline("$prompt "));
}

$ig = new ExtendedInstagram($debug, $truncatedDebug, $connection);
try {
    $ig->login($username, $password);
    foreach ($showStoryUsername as $story_username):
        $userID = $ig->people->getUserIdForName($story_username);
        $storyFeed = $ig->story->getUserStoryFeed($userID);
//        $photoFeed = $ig->timeline->getUserFeed($userID);
        if ($storyFeed->getReel() == null) {
            continue;
        }
        $storyItems = $storyFeed->getReel()->getItems();
        $storyCount = count($storyItems);
        for ($i = 0; $i < $storyCount; $i++) {
            if ($storyItems[$i]->getStoryCta() == null) {
                echo " ";
            } else {
            }
            if ($storyItems[$i]->getMediaType() == 1) {
                download($storyItems[$i]->getImageVersions2()->getCandidates()[0]->getUrl(), $story_username);

            } else {
                if ($storyItems[$i]->getStoryCta() == null) {
                    echo " ";
                } else {
                    echo " & <a href='" . $storyItems[$i]->getStoryCta()[0]->getLinks()[0]->getWebUri() . "'>webUri</a>";
                }
                download($storyItems[$i]->getVideoVersions()[0]->getUrl(), $story_username);
            }
        }
    endforeach;
    echo "Berhasil";
} catch (\Exception $e) {
    echo 'Something went wrong: ' . $e->getMessage() . "\n";
    $response = $e->getResponse();

    if ($e instanceof ChallengeRequiredException
        && $response->getErrorType() === 'checkpoint_challenge_required') {

        sleep(3);

        $checkApiPath = substr($response->getChallenge()->getApiPath(), 1);
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

        $code = readln('Code that you received via ' . ($verification_method ? 'email' : 'sms') . ':');
        $ig->changeUser($username, $password);
        $customResponse = $ig->request($checkApiPath)
            ->setNeedsAuth(false)
            ->addPost('security_code', $code)
            ->addPost('_uuid', $ig->uuid)
            ->addPost('guid', $ig->uuid)
            ->addPost('device_id', $ig->device_id)
            ->addPost('_uid', $ig->account_id)
            ->addPost('_csrftoken', $ig->client->getToken())
            ->getDecodedResponse();
        var_dump($customResponse);
        if ($customResponse['status'] === 'ok') {
            echo "Finished, logged in successfully! Run this file again to validate that it works.\n";
            echo 'Harap mengaktifkan koneksi ke database agar tidak terkena checkpoint. Coba lagi';
        } else {
            echo "Probably finished...\n";
            var_dump($customResponse);
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
//    exit(0);
}
  