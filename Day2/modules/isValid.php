<?php
function isValid($input, $len)
{
    // echo strlen($input) > $len || empty($input);
    if (strlen($input) > $len) {
        return false;
    } else {
        return true;
    }
}
