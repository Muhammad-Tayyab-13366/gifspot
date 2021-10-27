<?php
    include_once "insert.php";
    $connection = new mysqli($lh,$un,$pd,$db);
    if($connection->connect_error)die("failed to connect");
    $file_path = __FILE__;
    //$file_path;
    session_start();
    $visitor = $session('IP');
    $email = $session('email');
    //////////display data//////////
    $file = basename($file_path);
    if($file)
    {
        $select_file = <<<_END
        select products.*, pictures.picture from directory join
        products on directory.PID=products.PID join pictures on
        pictures.PID=products.PID and direct='$file'
        _END;
        $result_file = $query($connection,$select_file);
        if(!$result_file)die("failed");
        $column = $return($result_file);
        $name = htmlspecialchars($column['product']);
        $company = htmlspecialchars($column['company']);
        $quantity = htmlspecialchars($column['quantity']);
        $price = htmlspecialchars($column['price']);
        $PID = htmlspecialchars($column['PID']);
        $picture = htmlspecialchars($column['picture']);
    };
    ///////////buy now function////////
    $amount = intval($post('amount'));
    $buynow = $post('buynow');
    $cart = $post('cart');
    if(!empty($buynow) && !empty($amount))
    {
        $cookie_time = time() + 3600;
        setcookie('$amount', $amount, $cookie_time);
        setcookie('$PID', $PID, $cookie_time);
        header("Location:payment.php");
        exit();
    };
    //////////add to cart function/////////
    if(!empty($cart) && !empty($amount))
    {
        if(!empty($email)){
            /////get UID///
            $select = "select * from user where='$email'";
            $result = $query($connection, $select);
            $UID = $return($result)['UID'];
            /////insert to cart/////
            $insert =<<<_END
            insert into cart(UID,PID)
            value('$UID','$PID');
            _END;
            $result = $query($connection, $insert);
            if(!$result)die("failed to upload to cart");
        }else{
        $insert =<<<_END
        insert into visitor_cart(visitor,PID)
        value('$visitor','$PID');
        _END;
        $result = $query($connection, $insert);
        header("Location: $file");
        };
        

    };
    ////////////out of stock function///////////
    if($quantity === 0){
        $outofstock = "<h3>Agotado</h3>";
    };
    //////////
    echo<<<_END
    <!DOCTYPE html>
    <html>
    <head>
    <style>
    </style>
    </head>
    <body>
        <p>De $company</p>
        <img width="250px" id="pp" src="img/$picture">
        <h2>$name</h2>
        <form action="$file" id="qq" method="post">
        <p>$$price</p>
    _END;
    if($outofstock){
        echo "$outofstock";
    }else{
        echo "<input type='number' name='amount' min='1' max='$quantity' value=1><br>";
    };
    echo<<<_END
        <input type="submit" name="buynow" value="Comprar Ahora"><br>
        <input type="submit" name="cart" value="Agregar ah Carito">
        </form>
       $set
    </body>
    </html>
    _END;
?>
