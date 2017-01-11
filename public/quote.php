<?php
    
    //configuration
    require("../includes/config.php");
    
    //if reached via a link or clicking redirect
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Quote Lookup"]);
    }
    
    //had submitted a symbol into quote_form
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $quote = lookup($_POST["symbol"]);
        if($quote)
        {
             //format price
            $quote["price"] = "$" . $quote["price"];
            
            render("quote_display.php", ["title" => "quote", "quote" => $quote]);
        } else
        {
            apologize("Error looking up symbol!");
        }
        
    }

?>