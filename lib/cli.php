<?php

if(isset($argv[1]) && strtolower($argv[1]) == 'cli'){
    echo "Masukkan username : ";
    $username = trim(fgets(STDIN));
    echo "Masukkan password : ";
    system('stty -echo');
    $password = trim(fgets(STDIN));
    system('stty echo');
}
