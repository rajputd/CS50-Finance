<form action="buy.php" method="post">
    <fieldset>
        <div class="form-group">
            <input required autofocus autocomplete="off" class="form-control" placeholder="Symbol" name="symbol"  type="text"/>
            <input required autocomplete ="off" class="form-control" placeholder="Shares" min="1" name="shares" type="number"/>
            <button class="btn btn-default" type="submit">
                Submit
            </button>
        </div>
    </fieldset>
</form>