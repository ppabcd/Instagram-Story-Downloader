<?php
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function getVideoHTML($url)
{

    echo "</br><video width='480' height='850' controls>
    <source src='" . $url . "' type='video/mp4'>
  Your browser does not support the video tag.
  </video></br></br>";
}

function getImgHTML($url)
{

    echo "</br><img src='" . $url . "' width='480' height='850'></br></br>";
}

function download($url, $username = '')
{
    $file_name = basename($url);
    $file_name = explode("?", $file_name);
    $file_name = $file_name[0];
    if (!file_exists(__DIR__ . "/../data/")) {
        mkdir(__DIR__ . '/../data', 0777, true);
    }
    if (file_exists(__DIR__ . "/../data/" . $username . $file_name) || file_exists(__DIR__ . "/face/" . $username . $file_name) || file_exists(__DIR__ . "/trash/" . $username . $file_name) || file_exists(__DIR__ . "/profile/" . $username . $file_name)) {
        return;
    }
    // Use file_get_contents() function to get the file 
    // from url and use file_put_contents() function to 
    // save the file by using base name 
    if (file_put_contents(__DIR__ . "/../data/" . $username . $file_name, file_get_contents($url))) {
        echo "File downloaded successfully\n";
    } else {
        echo "File downloading failed.\n";
    }
}

?>
