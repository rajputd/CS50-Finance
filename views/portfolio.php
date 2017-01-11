<table class = "table table-striped">
    
    <thead>
        <tr>
            <th>
                Symbol
            </th>
            <th>
                Name
            </th>
            <th>
                Shares
            </th>
            <th>
                Current Price
            </th>
            <th>
                Total
            </th>
        </tr>
    </thead>
    
    <tbody>
    <?php foreach($positions as $position): ?>
            <tr>
                <td> <?= $position["symbol"] ?> </td>
                <td> <?= $position["name"] ?> </td>
                <td> <?= $position["shares"] ?> </td>
                <td> <?= $position["price"] ?> </td>
                <td> <?= $position["total"] ?> </td>
            </tr>
    <?php endforeach; ?>
        
    <?php foreach($descriptors as $key => $descriptor): ?>
            <tr>
                <td colspan = "4"> <?= $key ?> </td>
                <td> <?= $descriptor ?> </td>
            </tr>
    <?php endforeach; ?>
    
    </tbody>
    
</table>

