<!DOCTYPE html>

<html>
    <head>
        <title>
            table-complete
        </title>
        <style>
            table,td{
                border:1px solid blue;
                padding:1px;
            }
            
            td{
                text-align:center;
            }
        </style>
    </head>
    <body>
        <?php if(is_numeric($_GET["num"])): ?>
        <table>
        <?php for($i = 1; $i <= $_GET["num"]; $i++): ?>
            <tr>
                <?php for($j = 1; $j <= $_GET["num"]; $j++): ?>
                <td>
                    <?= $i * $j ?>
                </td>
                <?php endfor ?>
            </tr>

        <?php endfor ?>
        </table>
        <?php else: ?>
        not a valid number!
        <?php endif ?>
    </body>
</html>