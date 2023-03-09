<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> 
<script src="https://kit.fontawesome.com/a076d05399.js"></script> 
<!--icons font awesome5 --> 
<title>Cart System</title>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark"> <!-- Brand -->
    <a class="navbar-brand" href="index.php"><i class="fas fa-mobile-alt"></i> Mobile Store</a>
<!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> 
        <span class="navbar-toggler-icon"></span>
    </button>
<!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto"> <!-- add ml-auto to right :-) -- -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Checkout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="cart.php">
                    <i class="fas fa-shopping-cart">
                    <span id="cart-item" class="badge badge-danger"></span>
                    </i>
                </a>
            </li>
        </ul>
    </div>
</nav>


<div class="container">
   <div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="table-responsive mt-2">
        <table class="table table-bordered table-striped text-center">

        <thead>
            <tr>
                <td colspan="7">
                    <h4 class="text-center text-info m-0">Products in your cart!</h4>
                </td>
            </tr>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Qauntity</th>
                <th>Total Price</th>
                <th><a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear  your cart?')"><i class="fas fa-trash"></i>Clear Cart</a></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            require 'config.php';
            $stmt = $conn->prepare("SELECT * FROM cart");
            $stmt->execute();
            $result = $stmt->get_result();
            $grand_total = 0;
            while($row = $result->fetch_assoc()):

            ?>
            <tr>
            <td><?= $row['id']?></td>
            <td><img src="<?=$row['product_image'] ?>" width="50"></td>
            <td><?= $row['product_name']?></td>
            <td><?= number_format($row['product_price'])?></td>
            <td><input type="number" class="form-control itemQty" value="<?= $row['qty']?>">
        </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
        </table>
    </div>
</div>
</div>
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 

<script type="text/javascript">
    $(document).ready(function()
    {
       
        load_cart_item_number();

        function load_cart_item_number(){
            $.ajax(
                {
                    url: 'action.php',
                    method: 'get',
                    data: {cartItem:'cart_item'},
                    success:function(response){   
                        $("#cart-item").html(response);
                    }
            }); 
        }
    });
</script>

</body>
</html>


