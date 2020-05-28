<?php

if(isset($argv[1]) && strtolower($argv[1]) == 'cli'){
    echo "Masukkan username : ";
    $username = trim(fgets(STDIN));
    echo "Masukkan password : ";
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $password = trim(fgets(STDIN));
    } else {
        system('stty -echo');
        $password = trim(fgets(STDIN));
        system('stty echo');
    }
}
