<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Transaction</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach($history as $row): ?>
            <tr>
                <td><?=$row["type"]?></td>
                <td><?=date("m/d/y g:i A",strtotime($row["time"]))?></td>
                <td><?=$row["symbol"]?></td>
                <td><?=$row["shares"]?></td>
                <td><?="$" . $row["price"]?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>