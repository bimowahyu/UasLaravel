<html>
    <body>
        <form method="post">
        @csrf
            <label for="pesanan_id">No Order</label>
                    <input type="text" name="pesanan_id"/>
                    <br/>
                    <label for="nominal">Nominal</label>
                    <input type="text" name="nominal"/>
                <br/>
            <button>CHECKOUT</button>
        </form>
    </body>
</html>