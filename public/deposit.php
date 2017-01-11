<?php

    require("../includes/config.php");
    
    $id = $_SESSION["id"];
    
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("deposit_form.php", ["title" => "Deposit"]);
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $success = cs50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $_POST["deposit"], $id);
      
        if($success == 1)
        {
            render("deposit_success.php", ["title" => "Deposit Success"]);
        } else 
        {
            apologize("Sorry our database has encountered an error. Please try again later.");
        }
    }
    
    else
    {
        apologize("{$_SERVER["REQUEST_METHOD"]} is not a valid http method");
    }

?>