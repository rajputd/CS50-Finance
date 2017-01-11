<?php 

    //configure session
    require("../includes/config.php");
    
    $id = $_SESSION["id"];
    
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("buy_form.php", ["title" => "Buy"]);
    }

    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //check if shares is a non-negative integer
        if(!preg_match("/^\d+$/", $_POST["shares"]))
        {
            apologize("you put in a invalid share number");
        } else 
        {
            $shares = $_POST["shares"];
            
            //lookup price
            $symbol = mb_strtoupper($_POST["symbol"]);
            $quote = lookup($symbol);
        
            if($quote == false)
            {
                apologize("Please enter a valid stock symbol.");
            } else
            {
                $price = $quote["price"];
                $cash = cs50::query("SELECT cash FROM users WHERE id = ?", $id)[0]["cash"];
                $cost = $price * $shares;

                if($cash < $cost)
                {
                    apologize("You cannot afford {$shares} of {$symbol}.\nThat costs \${$cost} and you only have \${$cash}.");
                } else
                {
                    //update user transaction history
                    cs50::query("INSERT INTO  transactions ( user_id, TYPE , TIME, symbol, shares, price ) VALUES (?, 'BUY', NOW( ), ?, ?, ?)", 
                    $id, $symbol, $shares, $price);    
                
                    //format numbers
                     $cost = number_format($cost, 2, '.', ',');
                     $cash = number_format($cash, 2, '.', ',');
                
                    //update database
                    cs50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $cost, $id);
                    cs50::query("INSERT INTO portfolios (user_id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY 
                    UPDATE shares = shares + VALUES(shares)", $id, $symbol, $shares);
                    
                    render("buy_receipt.php", ["title" => "Receipt",
                                               "shares" => $shares, 
                                               "symbol" => $symbol, 
                                               "price" => $price, 
                                               "cost" => $cost]);
                }
            }
    }   }

?>