<?php

function passGenerator($amount)
{
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $generatedpw = "";

    $charactersamount = strlen($characters) - 1;

    while (strlen($generatedpw) < $amount) 
    {
        $randchar = rand(0, $charactersamount);
        $generatedpw .= $characters[$randchar];
    }
    return $generatedpw;
}

?>