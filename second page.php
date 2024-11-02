<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food World</title>
    <!-- logo in title bar -->
    <link rel="icon" href="../website/image/1000005311-removebg-preview.png" type="image/x-icon">
    <!-- css link -->
    <link rel="stylesheet" href="food.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- font-awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- jquery link -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- js link -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <!-- bootstrap js link -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        *::-webkit-scrollbar {
            display: none;
        }

        .navbar-custom {
            background-color: #03a9f4;
            /* nav bar blue */
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: black;
        }

        .navbar-custom .nav-link .fa {
            font-size: 20px;
        }

        /* quantity in fav */
        .quantity {
            border: 2px outset black;
            width: 4rem;
            text-align: center;
            margin: 0.5rem 0px;
            border-radius: 6px;
        }

        .inc {
            color: red;
        }

        .dec {
            color: green;
        }

        .inc:hover {
            color: gray;
        }

        .dec:hover {
            color: gray;
        }

        /* fav price details */
        table {
            width: 300px;
        }

        /* product card des */
        .product-scale {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* view more */
        .view_image {
            object-fit: contain;
            margin: 2px;
        }

        .view {
            border: 2px outset wheat;
            background-color: #D7E4C0;
            border-radius: 5px;
            margin-left: 15px;
            margin-bottom: 1rem;
        }

        .view_des {
            text-align: justify;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .releated_product {
            list-style: none;
            overflow: scroll;
            height: auto;
            margin-left: -50px;
            border-top: 2px solid rgb(246, 238, 238);
            border-bottom: 2px solid rgb(246, 238, 238);
            padding-top: 0.3rem;
            padding-bottom: 0.3rem;
        }

        .releated_p_item {

            margin-right: 0.3rem;
        }

        .releated_p_des {
            width: 150px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* svg inage in my order */
        .svg {
            width: 100vw;
            height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        /* aero cursor  */
        p,h1,h2,h3,h4,h5,h6,table {
            cursor: default;
        }
    </style>
</head>

<body>

    <?php
    // database connection
   include 'database.php';
    session_start();
    $user_id = null;
    if (isset($_SESSION['user_id']/*referance in login_logout.php*/)) {
        $user_id = $_SESSION['user_id']/*referance in login_logout.php*/ ;
    }
    //  code for favoruit  
    include 'fav.php';
    // code for product
    include 'product.php';
    // code for view more
    include 'view_more.php';
    // code for my order
    include 'order_page.php';
    // code for place order
    include 'place_order.php';
    // code for fav place order
    include 'fav_place_order.php';
    // code for order summary
    include 'oreder_summary.php';

    // name of the view product
    if (isset($_GET['view'])) {
        $product_id = $_GET['view'];
        $select_qry = "SELECT * FROM product WHERE product_id=$product_id";
        $result_select = mysqli_query($con, $select_qry);
        $row = mysqli_fetch_array($result_select);
        $heading = $row['product_name'];
    } elseif (isset($_GET['cat'])) {
        $heading = $_GET['cat'];
    } elseif (isset($_GET['user_serch'])) {
        $heading = $_GET['user_serch'];
    } elseif (isset($_GET['favorite'])) {
        $heading = "Favorite";
    } elseif (isset($_GET['releated_product'])) {
        $heading = "Releated Product";
    } elseif (isset($_GET['order'])) {
        $heading = "My Orders";
    }
    elseif (isset($_GET['order_product']) || isset($_GET['fav_order_product'])) //placeorder
    {
        $heading = "Order";
    }
    elseif (isset($_GET['order_summary'])) {
        $heading = "Order Summary";
    }
    // heading of the page
    function heading()
    {
        global $heading;
        $length=strlen($heading);
        ?>
        <?php
        if($length>=18)
        {
        $short_heading=substr($heading,0,15);
        echo $short_heading."...";
        }
        else
        {
            echo $heading;
        }
    }
    ?>

    <header class="sticky-top">
        <!-- nav bar -->
        <nav class="navbar navbar-expand-lg navbar-custom">
            <!-- back button -->
            <!-- script is end the page  -->
            <!-- script is present in end of page -->
            <a href="#" id="back"><i class="fas fa-arrow-left text-light m-3"></i><a>
                    <!-- heading and logo -->
                    <a class="navbar-brand" href="#">
                        <img src="../website/image/1000005311-removebg-preview.png" alt="FoodWorld logo" height="30"
                            style="margin-top: -5px;"><b class="pl-2 p-2 heading_second_page"
                            style="color:black"><?php heading();/*function present in top of page*/ ?></b>
                    </a>
                    <!-- menu bar button -->
                    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <!-- menu bar item -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto" action="" method="get">
                            <!-- item 1 -->
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">
                                    Home
                                </a>
                            </li>
                            <!-- item 2 -->
                            <?php
                            if (!isset($_GET['favorite'])) {
                                echo '<li class="nav-item">
                                <a class="nav-link" href="second page.php?favorite" title="fav">
                                    <i
                                        class="fa-regular fa-heart"></i><sup>';
                                num_card(); /*function present in end of page*/
                                echo '</sup>
                                </a>
                            </li>';
                            }
                            ?>
                            <!-- item 3 -->
                            <?php
                            if (!isset($_GET['order'])) {
                                echo '<li class="nav-item">
                                <a class="nav-link active " aria-current="page" href="second page.php?order">My
                                    Order</a>
                            </li>';
                            }
                            ?>
                            <!-- item 4 -->
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    About</i>
                                </a>
                            </li>
                        </ul>
                    </div>
        </nav>
    </header>
    <!-- condent of the page -->
    <div class="container-fluid pt-2">
        <div class="row">
            <?php
            // user_serch();
            if (isset($_GET['cat'])) {
                cat();
            } elseif (isset($_GET['user_serch'])) {
                user_serch();
            } elseif (isset($_GET['favorite'])) {
                fav();
            } elseif (isset($_GET['view'])) {
                view_more();
            } elseif (isset($_GET['releated_product'])) {
                releated_product();
            } elseif (isset($_GET['order']) && isset($user_id)) {
                my_order();
            }
            elseif (isset($_GET['order_product']))
            {
                // echo "ff";
                place_order();
            }
            elseif(isset($_GET['fav_order_product']))
            {
                fav_place_order();
            }
            elseif (isset($_GET['order_summary'])) {
                order_summary();
            }
            ?>
            
        </div>
        <!-- To display price details in fav -->
        <?php
        if (isset($_GET['favorite']) && $num >= 1 /*this number variable in fav.php */) {
            price_details();
        }
        ?>
    </div>
    <?php
    if (isset($_GET['view'])) {
        view_fooder();
    }
    ?>
    <script>
        let back=document.getElementById('back');
        back.addEventListener('click',function () {
            window.history.back();
        });
    </script>
</body>

</html>