<?php

    // configuration
    require("../includes/config.php"); 
    
    //get user's portfolio data
    $id = $_SESSION["id"];
    $table = cs50::query("SELECT symbol, shares FROM portfolios WHERE user_id = ?", $id);
    
    $positions = [];
    $portfolio_value = 0;

    // lookup stock prices and store all portfolio information into positions
    foreach($table as $row)
    {
        $stock = lookup($row["symbol"]);
        if($stock != false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => "$" . number_format($stock["price"], 2, '.', ','),
                "symbol" => $row["symbol"],
                "shares" => $row["shares"],
                "total" => "$" . number_format($stock["price"] * $row["shares"], 2, '.', ',')
                ];
            
            $portfolio_value += $stock["price"] * $row["shares"];
        };
    };
    
    //get the amount of money user has
    $table = cs50::query("SELECT cash FROM users WHERE id = ?", $id);
    $cash = $table[0]["cash"];
    
    
    $descriptors = ["Portfolio Value" => $portfolio_value, "Available Cash" => $cash];
    
    //format portfolio descriptors
    foreach($descriptors as $key => $descriptor)
    {
        $descriptors[$key] = "$" . number_format($descriptor, 2, '.', ',');
    };
    
    render("portfolio.php", ["title" => "Portfolio", "positions" => $positions, "descriptors" => $descriptors]);

?>
