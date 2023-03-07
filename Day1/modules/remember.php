<?php
function remember($input)
{
    if (isset($_POST[$input]) && !empty($_POST[$input])) {
        return $_POST[$input];
    }
}
