<form action="sell.php" method="post">
    <fieldset>
        <table class="table">
            <thead>
                <tr>
                    <th>symbol</th>
                    <th>shares</th>
                    <th>confirm</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>
                        <div class="form-group">
                            <select required class="form-control" name="symbol">
                                <option disabled selected value="">Select</option>
                                <?php foreach($symbols as $symbol):?>
                                    <option value= <?= $symbol["symbol"] ?> > <?= $symbol["symbol"] ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input required autocomplete="off" placeholder="number" class="form control" name="shares" type="number" min = "1"/>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <button class="btn btn-default" type="submit">
                                Sell
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</form>