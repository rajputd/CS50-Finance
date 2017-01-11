<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //check for username
        if(empty($_POST["username"]))
        {
            apologize("registration error: username cannot be empty");    
        }
        //check for password
        if(empty($_POST["password"]))
        {
            apologize("registration error: password cannot be empty");
        }
        //check if confirmation matches password
        if($_POST["confirmation"] != $_POST["password"])
        {
            apologize("registration error: confirmation must match password");  
        } 
        //check if username already exists, else registers user into database
        if(CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)",
        $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT)) != 0)
        {
            //login newly registered user
            $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            $_SESSION["id"] = $id;
            redirect("index.php");
            
        } else 
        {
            apologize("registration error: username: " . $_POST["username"] . " already exists");
        }
    }
?>