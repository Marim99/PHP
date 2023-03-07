<?php
require_once("modules/remember.php");
require_once("modules/clear.php");
require_once("config.php");
require_once("views/form.php");
require_once("views/welcome.php");
require_once("modules/isValid.php");

$msg = "";

if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["message"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    if (!isValid($name, __MAX_NAME_LEN__)) {
        $msg = "<center> <h1>" . _ERROR_MSG . "  name" . "</h1>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "<center> <h1>" . _ERROR_MSG . "  email" . "</h1>";
    } elseif (!isValid($message, __MAX_MESSAGE_LEN__)) {
        $msg = "<center> <h1>" . _ERROR_MSG . "  message" . "</h1>";
    } else {

        $msg = "  <center> <h1>" . _WELCOME_MSG . "</h1> </br></br>
       <p>Name: " . $name . "</p></br>" .
            " <p>Email: " . $email . "</p></br>" .
            "<p>Message:" . $message . " </p> </center>";


        // die($msg);
    }
    die($msg);
} else {
    die("<center> <h1>please Enter all data </h1></center>");
}
