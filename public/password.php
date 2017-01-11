<?php

    //establish session
    require("../includes/config.php");
    
    $id = $_SESSION["id"];
    
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("password_form.php", ["title" => "Change Password"]);
    }
    
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $row = cs50::query("SELECT hash FROM users WHERE id = ?", $id);
        $row = $row[0];
        
        
        if(password_verify($_POST["old_pass"], $row["hash"]))
        {
            //dump($row["hash"], $row);
            
            if($_POST["new_pass"] == $_POST["confirmation"])
            {
                $success = cs50::query("UPDATE users set hash = ? WHERE id = ?", password_hash($_POST["new_pass"], PASSWORD_DEFAULT), $id);
                if(empty($success))
                {
                    apologize("We encountered a database error. Please try again later.");
                } else
                {
                    render("password_success.php", ["title" => "Change Successful"]);

                }
                
            } else 
            {
                apologize("Confirmation must match the new password.");
            }
            
        } else
        {
            apologize("Please enter the correct old password");
        }
    }
    
    else 
    {
        apologize("sorry {$_SERVER["REQUEST_METHOD"]} is an invalid HTTP method.");
    }
    
?>