<table class="table-bordered table table-hover">
    <thead>
        <tr>
            <th>
                Symbol
            </th>
            <th>
                Name
            </th>
            <th>
                Price
            </th>
        </tr>
    </thead>
    
    <tbody>
        <tr>
            <?php foreach($quote as $value):?>
                <td>
                    <?= $value ?>
                </td>
            <?php endforeach; ?>
        </tr>
    </tbody>
    
</table>

<?php require("quote_form.php") ?>
