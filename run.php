<?php

use InstagramAPI\Instagram;

require("lib/config.php");
require("lib/functions.php");
require('lib/cli.php');

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
$ig = new Instagram($debug, $truncatedDebug, $connection);
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
} catch (\Exception $e) {
    echo 'Something went wrong: ' . $e->getMessage() . "\n";
    exit(0);
}
  