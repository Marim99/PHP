<?php

function save_to_File()
{
    $fp = fopen(_saving_file_, "a+");
    $written_string = date("M d Y h:i a") . "," . $_SERVER["REMOTE_ADDR"] . "," . $_POST["name"] . "," . $_POST["email"];
    fwrite($fp,  $written_string . PHP_EOL);
    fclose($fp);
}

function read_from_file()
{
    $fp = fopen(_saving_file_, "r+");
    $readed_file = fread($fp, filesize(_saving_file_));
    fclose($fp);
    return $readed_file;
}

function convert_file_to_array()
{
    $arr = explode("\n", file_get_contents(_saving_file_));
    return $arr;
}
