<?php

require 'config.php';

function RedirectURL($path){

    global $folder_location;

    if(isset($_SERVER['HTTPS'])) {
        $link = 'Location: https://'.$_SERVER['HTTP_HOST']. $folder_location . $path;
    } else{
        $link = 'Location: http://'.$_SERVER['HTTP_HOST']. $folder_location . $path;
    }

    header($link);
}


?>