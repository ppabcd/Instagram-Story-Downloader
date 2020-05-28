<?php
require __DIR__ . "/lib/FaceDetection.php";
if (!file_exists(__DIR__.'/face')) {
    mkdir(__DIR__.'/face', 0777, true);
}
if (!file_exists(__DIR__.'/trash')) {
    mkdir(__DIR__.'/trash', 0777, true);
}
if(!file_exists(__DIR__.'/profile/face')){
    mkdir(__DIR__.'/profile/face');
}
if(!file_exists(__DIR__.'/profile/trash')){
    mkdir(__DIR__.'/profile/trash');
}
foreach(glob(__DIR__."/data/*.jpg") as $filename){
    if(file_exists(__DIR__."/face/".basename($filename)) || file_exists(__DIR__."/trash/".basename($filename)) ){
        unlink(__DIR__."/data/".basename($filename));
        continue;
    }
    if(detect_label(__DIR__."/data/".basename($filename))){
        rename(__DIR__."/data/".basename($filename), __DIR__."/face/".basename($filename));
    }
    else {
        rename(__DIR__."/data/".basename($filename), __DIR__."/trash/".basename($filename));
    }
}
foreach(glob(__DIR__."/profile/*.jpg") as $filename){
    if(file_exists(__DIR__."/profile/face/".basename($filename)) || file_exists(__DIR__."/profile/trash/".basename($filename)) ){
        unlink(__DIR__."/profile/".basename($filename));
        continue;
    }
    if(detect_label(__DIR__."/profile/".basename($filename))){
        rename(__DIR__."/profile/".basename($filename), __DIR__."/profile/face/".basename($filename));
    }
    else {
        rename(__DIR__."/profile/".basename($filename), __DIR__."/profile/trash/".basename($filename));
    }
}