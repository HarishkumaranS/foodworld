<style>
    .card {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 2px;
    }

    .card-header {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .table {
        margin-bottom: 0;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    form input,
    form select,
    form textarea {
        border-radius: 5px;
        border: 1px solid #d0d0d0;
    }

    .btn-primary {
        background-color: #2874f0;
        border: none;
    }

    .btn-primary:hover {
        background-color: #236ad4;
    }

    .btn-primary:focus {
        box-shadow: none;
    }

    .img-fluid {
        object-fit: cover;
        height: 237px;
        width: 237px;
    }

    .select_option {
        cursor: pointer;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 1.3rem;
        }

        .card-body {
            text-align: center;
        }

        .row.g-0 .col-md-4 {
            display: flex;
            justify-content: center;
        }

        .row.g-0 .col-md-8 {
            padding-top: 10px;
        }
    }

    @media (max-width: 576px) {
        .card-body {
            text-align: left;
        }
    }

    /* green tick */
    .confirmation-container {
        margin: 10px;
        background-color: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        text-align: center;
        max-width: 400px;
        width: 100%;
    }

    .checkmark-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .checkmark {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #4CAF50;
        position: relative;
        animation: scaleUp 0.5s ease-in-out forwards;
        /* Added zoom in effect */
    }

    .checkmark:after {
        content: "";
        position: absolute;
        left: 50%;
        top: 50%;
        width: 0;
        height: 0;
        border: solid white;
        border-width: 0 6px 6px 0;
        transform: translate(-50%, -50%) rotate(45deg);
        animation: drawCheck 1s ease forwards 0.5s;
        /* Draw the tick */
    }

    h1 {
        font-size: 24px;
        color: #333;
        margin-bottom: 15px;
    }

    p {
        font-size: 16px;
        color: #555;
        margin-bottom: 25px;
    }

    .order-button {
        background-color: #4CAF50;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .order-button:hover {
        color: white;
        background-color: #45a049;
    }

    /* Tick Animation */
    @keyframes drawCheck {
        0% {
            width: 0;
            height: 0;
        }

        50% {
            width: 16px;
            height: 0;
        }

        100% {
            width: 16px;
            height: 32px;
        }
    }

    /* Scale animation for the green circle */
    @keyframes scaleUp {
        0% {
            transform: scale(0);
        }

        70% {
            transform: scale(1.2);
            /* Slight over-scale */
        }

        100% {
            transform: scale(1);
            /* Pop back to full size */
        }
    }

    /* Bounce effect after tick is drawn */
    @keyframes bounce {

        0%,
        100% {
            transform: translate(-50%, -50%) scale(1);
        }

        50% {
            transform: translate(-50%, -50%) scale(1.1);
        }
    }

    /* product stock */
    #disabled {
        cursor: not-allowed;
    }
</style>
<?php
// database connection
   include 'database.php';
if (isset($_GET['fav_order_product'])) {
    if (isset($user_id)) {
        function fav_place_order()
        {
            global $user_id, $con;
            $select_qry = "SELECT MIN(qty) AS min_qty from fav WHERE user_id=$user_id";
            $result_qry = mysqli_query($con, $select_qry);
            $row = mysqli_fetch_array($result_qry);
            $min_qty = $row['min_qty'];
            if (isset($_POST['submit']) && $min_qty != 0) {
                $mob_num2 = $_POST['num2'];
                $address = $_POST['addres'];
                $payment_type = $_POST['payment_type'];
                $update_qry = "UPDATE user SET mob_num2=$mob_num2,address='$address' where user_id=$user_id";
                $result_update = mysqli_query($con, $update_qry);
                $select_qry = "SELECT * FROM fav where user_id=$user_id";
                $result_qry = mysqli_query($con, $select_qry);
                while ($row = mysqli_fetch_array($result_qry)) {
                    $product_id = $row['product_id'];
                    $product_qty = $row['qty'];
                    $product_price
                        = $row['fav_c_price'];
                    $insert_qry = "INSERT INTO user_order(product_id,user_id,qty,o_price,payment_id,o_date,d_date)values($product_id,$user_id,$product_qty, $product_price,$payment_type,now(),DATE_ADD(NOW(),INTERVAL 1 HOUR))";
                    $result_insert = mysqli_query($con, $insert_qry);
                    // to display the delivered date and time in order Confirmed page 
                    $last_id=mysqli_insert_id($con);
                    // update stock
                    $update_qry = "UPDATE product SET product_stock=product_stock-$product_qty where product_id=$product_id";
                    $result_update = mysqli_query($con, $update_qry);
                }
                if ($result_insert) {
                    // delivered date
                     $select_qry="SELECT d_date from user_order Where o_id=$last_id";
                     $result_qry=mysqli_query($con,$select_qry);
                    $row=mysqli_fetch_array($result_qry);
                    ?>
                    <div class="svg">
                        <div class="confirmation-container">
                            <div class="checkmark-container">
                                <div class="checkmark"></div>
                            </div>
                            <h1>Order Confirmed!</h1>
                            <p>Your order has been successfully placed and will be delivered on <?php echo $row['d_date']; ?>. <br>Thank you for choosing us.</p>
                            <a href="second page.php?order" class=" nav-link order-button">Go to My Order</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                $select_fav = "SELECT product_id,qty,c_price,fav_c_price,p_price,fav_p_price from fav where user_id=$user_id";
                $resulr_fav = mysqli_query($con, $select_fav);
                ?>
                <div class="container my-3">
                    <div class="row">
                        <!-- Dynamic Product Cards (Main Content) -->
                        <div class="col-lg-8 col-md-7 col-sm-12 mb-3" id="product-cards">
                            <?php
                            while ($row_fav = mysqli_fetch_array($resulr_fav)) {
                                $product_id = $row_fav['product_id'];
                                $product_price = $row_fav['fav_p_price'];
                                $product_price_c = $row_fav['fav_c_price'];
                                $fav_qty = $row_fav['qty'];
                                $select_product = "SELECT product_name,product_img,product_stock FROM product WHERE product_id=$product_id";
                                $result_product = mysqli_query($con, $select_product);
                                $row = mysqli_fetch_array($result_product);
                                $product_image = $row['product_img'];
                                $product_name = $row['product_name'];
                                $product_stock = $row['product_stock'];
                                if ($product_stock >= $fav_qty) {
                                    $product_qty = $fav_qty;
                                } else {
                                    $product_qty = $product_stock;
                                    $update_qry = "UPDATE fav SET qty=$product_qty where product_id=$product_id and user_id=$user_id";
                                    $update_result = mysqli_query($con, $update_qry);
                                }
                                ?>
                                <div class="card md-3">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <a href='second page.php?view=<?php echo $product_id; ?>'><img src="./admin/product_image/<?php echo $product_image; ?>"
                                                class="img-fluid rounded-start p-2" alt="<?php echo $product_name; ?>"></a>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $product_name; ?></h5>
                                                <table>
                                                    <tr>
                                                        <th class='p-2'>
                                                            Price
                                                        </th>
                                                        <th>
                                                            <spam id="product_price"><?php echo $product_price; ?></spam>/-
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class='p-2'>
                                                            Discound
                                                        </th>
                                                        <th class='text-success'>-
                                                            <spam id="product_discount"><?php echo $product_price - $product_price_c; ?>
                                                            </spam>
                                                            /-
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class='p-2'>
                                                            Total Amount
                                                        </th>
                                                        <th>
                                                            <spam id="total_price"><?php echo $product_price_c; ?></spam>/-
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class='p-2'>
                                                            Quantity
                                                        </th>
                                                        <th>
                                                            <div class='quantity'>
                                                                <a href='second page.php?dec_id=<?php echo $product_id; ?>' class='dec'><i
                                                                        class='fa-solid fa-circle-minus'></i></a>
                                                                <span><?php echo $product_qty; ?></span>
                                                                <a href='second page.php?inc_id=<?php echo $product_id; ?>' class='inc'><i
                                                                        class='fa-solid fa-circle-plus'></i><a>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <!-- Order Summary & Checkout (Sidebar) -->
                        <?php
                        $select_qry = "SELECT SUM(qty) as total_qty,SUM(fav_c_price) as total_price FROM fav where user_id=$user_id";
                        $resulr_qry = mysqli_query($con, $select_qry);
                        $row = mysqli_fetch_array($resulr_qry);
                        $total_item = $row['total_qty'];
                        $total_price = $row['total_price'];
                        ?>
                        <div class="col-lg-4 col-md-5 col-sm-12">
                            <div class="card mb-3">
                                <div class="card-header bg-success text-white">
                                    <h5>Order Summary</h5>
                                </div>
                                <div class="card-body">
                                    <p>Total Items: <?php echo $total_item; ?> </p>
                                    <p>Total Price: ₹<?php echo $total_price; ?>/-</p>
                                </div>
                            </div>

                            <!-- Checkout Form -->
                            <?php
                            $select_qry = "SELECT user_name,mob_num1,mob_num2,address FROM user where user_id=$user_id";
                            $resulr_qry = mysqli_query($con, $select_qry);
                            $row = mysqli_fetch_array($resulr_qry);
                            $user_name = $row['user_name'];
                            $user_mob1 = $row['mob_num1'];
                            $user_mob2 = $row['mob_num2'];
                            $user_addres = $row['address'];
                            ?>
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h5>Checkout</h5>
                                </div>
                                <div class="card-body">
                                    <form id="order-form" action="" method="post">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Full Name: </label>
                                            <h5><?php echo $user_name; ?></h5>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mobile" class="form-label">Mobile Number 1:</label>
                                            <h5><?php echo $user_mob1; ?></h5>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mobile" class="form-label">Mobile Number 2:</label>
                                            <input type="tel" id="mobile" class="form-control" pattern="[0-9]{10}" required
                                                value="<?php echo $user_mob2; ?>" name="num2">
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address:</label>
                                            <textarea id="address" class="form-control" rows="3" required
                                                name="addres"><?php echo $user_addres; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <?php
                                            $select_qry = "SELECT * FROM payment";
                                            $resulr_qry = mysqli_query($con, $select_qry);

                                            ?>
                                            <label for="payment-method" class="form-label">Payment Method:</label>
                                            <select id="payment-method" class="form-select select_option" name="payment_type" required>
                                                <?php
                                                while ($p_row = mysqli_fetch_array($resulr_qry)) {
                                                    $payment_id = $p_row['payment_id'];
                                                    $payment_type = $p_row['payment_type'];
                                                    echo "<option class='select_option' value='$payment_id'>$payment_type</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <?php
                                        $select_qry = "SELECT MIN(qty) AS min_qty from fav WHERE user_id=$user_id";
                                        $result_qry = mysqli_query($con, $select_qry);
                                        $row = mysqli_fetch_array($result_qry);
                                        $min_qty = $row['min_qty'];
                                        ?>
                                        <input type="submit" name="submit" class="btn btn-info" value="Place Order" <?php if ($min_qty <= 0) {
                                            echo 'id="disabled"';
                                        } ?>>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    } else {
        echo "<script>window.location.href='login_logout.php?login';</script>";
    }
}
?>