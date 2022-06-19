<?php
    
    function bnrGenerator($amount)
{
    $characters = "1234567890";
    $generatedbnr = "";

    $charactersamount = strlen($characters) - 1;

    while (strlen($generatedbnr) < $amount) 
    {
        $randchar = rand(0, $charactersamount);
        $generatedbnr .= $characters[$randchar];
    }
    return $generatedbnr;
}

?>