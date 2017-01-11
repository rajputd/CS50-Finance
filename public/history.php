<?php

    //configuration
    require("../includes/config.php");
    
    $id = $_SESSION["id"];
    
    $history = cs50::query("SELECT type, time, symbol, shares, price FROM transactions WHERE user_id = ?", $id);
    render("history_display.php", ["title" => "History", "history" => $history])
    
?>