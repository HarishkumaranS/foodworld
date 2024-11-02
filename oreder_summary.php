<style>
    .status-badge {
        font-size: 1rem;
        padding: 5px 10px;
        margin-bottom: 10px;
    }

    .product-image {
        object-fit: contain;
        width: 400px;
        /* Make image responsive */
        height: 400px;
        /* Maintain aspect ratio */
    }

    @media screen and (max-width:991px) {
        .product-image {
            object-fit: contain;
            width: 95%;

            height: 250px;
        }
    }

    .total-price {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .delivery-info {
        margin-top: 15px;
        font-size: 1rem;
        font-weight: bold;
    }

    .condent {
        margin-top: 2rem;
    }
</style>
<?php
// database connection
include 'database.php';
if (isset($_GET['order_summary'])) {
    $order_id = $_GET['order_summary'];
    function order_summary()
    {
        global $user_id, $con, $order_id;
        // user_order table
        $select_order = "SELECT * FROM user_order where o_id= $order_id";
        $result_order = mysqli_query($con, $select_order);
        $row_order = mysqli_fetch_array($result_order);
        $product_id = $row_order['product_id'];
        $order_price = $row_order['o_price'];
        $order_date = $row_order['o_date'];
        $delivered_date = $row_order['d_date'];
        $order_qty = $row_order['qty'];
        $status = $row_order['status'];
        $payment_id=$row_order['payment_id'];
        // payment table
        $select_pay="SELECT payment_type FROM payment WHERE payment_id=$payment_id";
        $result_pay=mysqli_query($con,$select_pay);
        $row_pay=mysqli_fetch_array($result_pay);
        $payment_type=$row_pay['payment_type'];
        // product table
        $select_qry = "SELECT product_name,product_scale,product_img FROM product where product_id=$product_id";
        $result_qry = mysqli_query($con, $select_qry);
        $row_product = mysqli_fetch_array($result_qry);
        $product_name = $row_product['product_name'];
        $product_scale = $row_product['product_scale'];
        $product_img = $row_product['product_img'];
        // user table
        $select_user = "SELECT address FROM user WHERE user_id=$user_id";
        $result_user = mysqli_query($con, $select_user);
        $row_user = mysqli_fetch_array($result_user);
        $address = $row_user['address'];

        ?>
        <!-- Product Image -->
        <div class="col-12 col-md-4 text-center condent">
        <a href='second page.php?view=<?php echo $product_id; ?>'><img src="./admin/product_image/<?php echo $product_img; ?>" alt="Product Image" class="img-fluid product-image"></a>
        </div>

        <!-- Product Details -->
        <div class="col-12 col-md-8 condent">
            <h4><?php echo $product_name; ?></h4>
            <p><?php echo $product_scale; ?></p>

            <p><strong>Price:</strong> ₹<?php echo $order_price / $order_qty; ?></p>
            <p><strong>Quantity:</strong> <?php echo $order_qty; ?></p>

            <!-- Total Price under Quantity -->
            <p class="total-price">Total Price: ₹<?php echo $order_price; ?></p>

            <p><strong>Order Date:</strong> <?php echo $order_date; ?></p> <!-- Added Order Date -->
            <p><strong>Payment Type:</strong> <?php echo $payment_type; ?></p>
            <!-- Status Badge -->
            <div class="d-flex align-items-center">
                <?php if ($status == 1) {
                        echo "<span class='badge  status-badge text-light' style='background-color:green;'>Delivered</span>";
                    } else {
                        echo "<span class='badge  status-badge text-light' style='background-color:red;'>Pending</span>";
                    } ?>
            </div>

            <!-- Delivery Information -->
            <div class="delivery-info">
                <p><strong>Delivery Date <?php if ($status == 0) { echo '(Expected)';} ?>:</strong> <?php echo $delivered_date; ?></p>
            </div>

            <!-- Shipping Address -->
            <div class="mt-3">
                <h5>Shipping Address</h5>
                <p><?php echo $address; ?></p>
            </div>
        </div>

        <?php
    }
}
?>