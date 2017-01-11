<?php 

    // configuration
    require("../includes/config.php"); 
    
    $id = $_SESSION["id"];
    
    //get symbols for sell_form's select menu
    $symbols = cs50::query("SELECT symbol FROM portfolios WHERE user_id = ?", $id);
    
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("sell_form.php", ["title" => "Sell Form", "symbols" => $symbols]);
    }
    
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //check form inputs
        if(empty($_POST["symbol"]))
        {
            apologize("Please select a symbol.");
        } else if (empty($_POST["shares"]))
        {
            apologize("Please enter the number of shares to be sold.");
        } 
        else
        {
            $symbol_sold = $_POST["symbol"];
            $shares_sold = $_POST["shares"];
            $shares_owned = cs50::query("SELECT shares FROM portfolios WHERE user_id = ? AND symbol = ?", $id, $symbol_sold)[0]["shares"];
            
            if($shares_sold > $shares_owned)
            {
                apologize("You cannot sell {$shares_sold} shares you only own {$shares_owned} shares.");
            } else
            {
                $price = lookup($symbol_sold)["price"];
                if(empty($price))
                {
                    apologize("could not find the current price of the stock");
                } else 
                {
                    cs50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $price * $shares_sold, $id);
                    cs50::query("UPDATE portfolios SET shares = ? WHERE user_id = ? AND symbol = ?", $shares_owned - $shares_sold, $id, $symbol_sold);
                    
                    //update user transaction history
                    cs50::query("INSERT INTO  transactions ( user_id, TYPE , TIME, symbol, shares, price ) VALUES (?, 'SELL', NOW( ), ?, ?, ?)", 
                    $id, $symbol_sold, $shares_sold, $price);    
                    
                    $receipt = ["symbol" => $symbol_sold, 
                                "shares_sold" => $shares_sold, 
                                "shares_left" => $shares_owned - $shares_sold,
                                "price" => number_format($price, 2, '.', ','),
                                "total" => number_format($price * $shares_sold, 2, '.', ',')];
                    
                    render("reciept.php", ["title" => "Receipt", "receipt" => $receipt]);
                }
                

                
            }
            
        }
        
        
       
    }

?>