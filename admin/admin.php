<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashbord</title>
    <!-- logo in title bar -->
    <link rel="icon" href="../../website/image/1000005311-removebg-preview.png" type="image/x-icon">
    <!-- css link -->
    <link rel="stylesheet" href="../food.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        /* admin table */
        @media only screen and (min-width< 1280px) {
            .screen {
                display: none;
            }
        }

        .condent2 {
            display: flex;
            position: relative;
            height: 100vh;
            width: 100vw;
            color: white;
            flex-direction: column;
            background: linear-gradient(to bottom right, rgb(40, 39, 39), rgb(102, 101, 101));
            align-items: center;
            justify-content: center;
        }

        body {
            background-image: url("../../website/image/240_F_787845431_4FIsmxl5QYCXatViwdhf5MdKZEKqDhxA.jpg");
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            width: 100%;
            height: auto;
            font-family: Calibri, serif;
        }

        /* admin page table */
        .th {
            background-color: black;
            color: wheat;
        }

        .del_color {
            cursor: pointer;
            color: #6c757d;
        }

        .edit_color {
            color: #6c757d;
        }

        .edit_color:hover {
            transform: scale(1.3);
            color: #2196f3;
        }

        .del_color:hover {
            color: #ff0000;
            transform: scale(1.3);
        }
/* svg image for responcive computer svg image */
        svg {
            position: relative;
            z-index: 2;
        }
        .svg {
            display: flex;
            justify-content: center;
        }

        #particles {
            width: 100%;
            /* Full width of the container */
            height: 100%;
            /* Full height of the container */
            position: absolute;
            /* Fill the container */
            top: 0;
            left: 0;
            z-index: 1;
            /* Behind other content */
        }

        h3 {
            position: relative;
            /* Keep the heading above the canvas */
            z-index: 2;
            /* Ensure it's above the canvas */
            margin-top: 20px;
            /* Add some spacing */
        }

        /* .mediascreen
        {
            margin: 1rem;
        }
        .particles
        {
            position: relative;
            height: 150vh;
            margin-top: -75vh;

        } */
        .title{
    font-family:Algerian,broadway;
   color: black;
}
.btn:hover
{
transform: scale(1.05);
}
.btn:active
{
    transform: scale(1.05); 
}
    </style>
</head>

<body>
    <div class="d-none d-lg-block">
        <?php
        session_start();
        // delivered_product
        include "delivered_product.php";
        //editdel_category
        include "editdel_category.php";
        //editdel_payment
        include "editdel_payment.php";
        //editdel_product
        include "editdel_product.php";
        //insert_cat
        include "insert_cat.php";
        //insert_payment
        include "insert_payment.php";
        //insert_product
        include "insert_product.php";
        //view_product
        include "view_product.php";
        //view_category
        include "view_category.php";
        //user_list
        include "user_list.php";
        //view_payment
        include "view_payment.php";
        //pending_order
        include "pending_order.php";
        //report
        include "report.php";
        //login
        include "login.php";
        ?>
        <!-- header -->
        <header>
            <!-- title and logo -->
            <div class="container-fluid  p-2 pt-3 pb-1" style="background-color: #03a9f4;">
                <p class="display-6"><img class="logo"
                        src="../../website/image/1000005311-removebg-preview.png">&nbsp;&nbsp;<b
                        class="text-end title">Admin Dashbord</b></p>
            </div>
        </header>
        <!-- button -->
        <div class="container-fluid   pt-3 pb-1 mb-2 bg-secondary sticky-top">
            <div class="row pb-2" align="center">
                <div class="col">
                    <button class="btn btn-info bg-info mb-2 me-2">
                        <a href="admin.php?insert_product" class="nav-link text-light bg-info my-1 ">Insert Product</a>
                    </button>
                    <button class="btn btn-info mb-2 me-2">
                        <a href="admin.php?view_product" class="nav-link text-light bg-info my-1">View Product</a>
                    </button>

                    <button class="btn btn-info mb-2 me-2">
                        <a href="admin.php?insert_cat" class="nav-link text-light bg-info my-1">Insert categories</a>
                    </button>
                    <button class="btn btn-info mb-2 me-2">
                        <a href="admin.php?view_cat" class="nav-link text-light bg-info my-1">View categories</a>
                    </button>
                    <button class="btn btn-info mb-2 me-2">
                        <a href="admin.php?insert_payment" class="nav-link text-light bg-info my-1">Insert Payments</a>
                    </button>
                    <button class="btn btn-info mb-2 me-2">
                        <a href="admin.php?view_payment" class="nav-link text-light bg-info my-1">View Payments</a>
                    </button>
                    <button class="btn btn-info mb-2 me-2">
                        <a href="admin.php?pending_order" class="nav-link text-light bg-info my-1">Pending Orders</a>
                    </button>
                    <button class="btn btn-info mb-2 me-2">
                        <a href="admin.php?delivered_order" class="nav-link text-light bg-info my-1">Delivered
                            Orders</a>
                    </button>
                    <button class="btn btn-info mb-2 me-2">
                        <a href="admin.php?user_list" class="nav-link text-light bg-info my-1">User List</a>
                    </button>
                    <button class="btn btn-info mb-2 me-2">
                        <a href="admin.php?report" class="nav-link text-light bg-info my-1">Generate Report</a>
                    </button>
                    <button class="btn btn-info mb-2 me-2">
                        <a <?php if(isset($_SESSION['login'])){ echo 'id ="logout"'; }else{ echo'href="admin.php?login"';}?>  class="nav-link text-light bg-info my-1"><?php if(isset($_SESSION['login']))
                        {echo "Logout";}else{ echo "login";}?></a>
                    </button>
                </div>
            </div>
        </div>
        <!-- output of the button and content of the page -->
        <div class="container  text-dark">
            <?php
            // database connection
            include './../database.php';
            if (isset($_GET["insert_cat"])) {
                insert_cat();
            } elseif (isset($_GET["insert_product"])) {
                insert_product();
            } elseif (isset($_GET['view_product'])) {
                view_product();
            } elseif (isset($_GET['view_cat'])) {
                view_category();
            } elseif (isset($_GET['PEid']) || isset($_GET['PDid'])) {
                editdel_product();
            } elseif (isset($_GET['CEid']) || isset($_GET['CDid'])) {
                editdel_category();
            } elseif (isset($_GET['user_list']) || isset($_GET['user_Did'])) {
                user_list();
            } elseif (isset($_GET['view_payment'])) {
                view_payment();
            } elseif (isset($_GET['insert_payment'])) {
                insert_payment();
            } elseif (isset($_GET['pay_Eid']) || isset($_GET['pay_Did'])) {
                editdel_payment();
            } elseif (isset($_GET['pending_order'])) {
                pending_order();
            } elseif (isset($_GET['delivered_order'])) {
                delivered_order();
            } elseif (isset($_GET['report']) || isset($_GET['pdf'])) {
                report();
            }
            elseif (isset($_GET['login']) ||isset($_GET['logout']) ) {
                login();
            } else {
                echo '<div class="svg"><svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" width="889.07556" height="459.37952" viewBox="0 0 889.07556 459.37952" xmlns:xlink="http://www.w3.org/1999/xlink"><title>welcome_cats</title><ellipse cx="444.53778" cy="398.16856" rx="444.53778" ry="12.43462" fill="#e6e6e6"/><path d="M836.90729,483.74151c-.56135.0077-1.12265.0154-1.69165.0154s-1.1303-.0077-1.69164-.0154c-29.75741-.67665-51.32574-19.26925-45.83561-38.77687l13.387-47.58878,3.38328-12.04134,59.97615,1.02263,3.6447,11.77994,14.34816,46.36621C888.50213,464.11853,866.93379,483.06486,836.90729,483.74151Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M868.07949,398.13709a66.201,66.201,0,0,1-67.00413-.76123l3.38328-12.04134,59.97615,1.02263Z" transform="translate(-155.46222 -220.31024)" opacity="0.2"/><path d="M865.54813,446.54371c2.59087-9.656,11.10609-23.5853,34.98657-40.37992,41.64786-29.29427,16.80312-51.25925,15.72654-52.1796-2.25846-1.93041-1.92491-4.09793.77549-4.83852a11.22377,11.22377,0,0,1,9.03426,2.10278c1.34843,1.11541,32.45928,27.68293-14.53706,60.73417-42.29508,29.74951-33.30237,49.16914-33.1992,49.35545,1.13341,2.077-.684,3.73882-4.063,3.71644s-7.03927-1.72268-8.17623-3.7975C865.8564,460.81807,863.1348,455.53283,865.54813,446.54371Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M807.53434,490.67723a6.92019,6.92019,0,0,1-6.92032-6.92032V453.76883a6.92032,6.92032,0,0,1,13.84065,0v29.98808A6.92019,6.92019,0,0,1,807.53434,490.67723Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M813.602,419.48415a6.92019,6.92019,0,0,1-9.17934,3.39434l-27.243-12.53415a6.92033,6.92033,0,0,1,5.785-12.57368l27.243,12.53415A6.92019,6.92019,0,0,1,813.602,419.48415Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M856.82926,419.48415a6.92019,6.92019,0,0,0,9.17934,3.39434l27.243-12.53415a6.92032,6.92032,0,0,0-5.785-12.57368l-27.243,12.53415A6.9202,6.9202,0,0,0,856.82926,419.48415Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M862.89684,490.67723a6.92018,6.92018,0,0,0,6.92032-6.92032V453.76883a6.92032,6.92032,0,1,0-13.84064,0v29.98808A6.92018,6.92018,0,0,0,862.89684,490.67723Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M891.81774,296.5349a6.80558,6.80558,0,0,0,1.3735-5.40838l-3.76639-22.157-3.76639-22.157a6.913,6.913,0,0,0-11.22615-4.16441L857.127,256.9884l-10.42587,8.63951a65.69368,65.69368,0,0,0-21.04716-.31735l-10.04291-8.32216-17.30532-14.34028a6.913,6.913,0,0,0-11.22614,4.16441l-3.76639,22.157-3.76639,22.157a6.8438,6.8438,0,0,0,.30144,3.47373,66.11762,66.11762,0,1,0,111.96948,1.93465Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M796.57153,251.7278a3.447,3.447,0,0,0-1.20182.21814,3.38791,3.38791,0,0,0-2.18438,2.6353L788.618,281.45081a3.4226,3.4226,0,0,0,4.56474,3.7823l25.55323-9.47941a3.42226,3.42226,0,0,0,.99345-5.84352l-.00038-.00076-20.98549-17.38979A3.39218,3.39218,0,0,0,796.57153,251.7278Z" transform="translate(-155.46222 -220.31024)" fill="#e6e6e6"/><path d="M876.16653,251.7278a3.39218,3.39218,0,0,0-2.172.79183l-20.98587,17.39055a3.42226,3.42226,0,0,0,.99344,5.84352l25.55324,9.47941a3.4226,3.4226,0,0,0,4.56474-3.7823l-4.56737-26.86957a3.38788,3.38788,0,0,0-2.18437-2.6353A3.447,3.447,0,0,0,876.16653,251.7278Z" transform="translate(-155.46222 -220.31024)" fill="#e6e6e6"/><circle cx="679.75342" cy="119.65771" r="9.2271" fill="#e6e6e6"/><ellipse cx="679.75342" cy="115.04416" rx="6.1514" ry="2.30677" fill="#3f3d56"/><path d="M675.13987,125.04018H683.598a0,0,0,0,1,0,0v10.38049a4.22908,4.22908,0,0,1-4.22908,4.22908h0a4.22908,4.22908,0,0,1-4.22908-4.22908V125.04018a0,0,0,0,1,0,0Z" fill="#ff6584"/><path d="M835.729,240.68976c-.4435.91976-.87414,1.84948-1.27916,2.7982a65.81817,65.81817,0,0,0-4.65081,35.34384c.86574-1.25608,1.77556-2.56471,2.701-3.88776A65.775,65.775,0,0,1,835.729,240.68976Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M842.64935,249.14794c-.4435.91976-.87415,1.84947-1.27916,2.79819A65.81818,65.81818,0,0,0,836.71937,287.29c.86575-1.25607,1.77556-2.56471,2.70095-3.88775A65.775,65.775,0,0,1,842.64935,249.14794Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M863.98522,415.199l-.97489-12.39806-.97489-12.39809a3.82528,3.82528,0,0,0-5.98-2.8528l-10.24962,7.04331-7.48458,5.14325a5.09542,5.09542,0,0,0-7.74914,0l-7.48459-5.14325L812.83794,387.55a3.82528,3.82528,0,0,0-5.98,2.8528l-.97489,12.39809-.97489,12.39806a3.82528,3.82528,0,0,0,5.4606,3.75238l11.22448-5.35474,9.22263-4.39977a5.10117,5.10117,0,0,0,7.26159,0l9.22264,4.39977,11.22448,5.35474A3.82528,3.82528,0,0,0,863.98522,415.199Z" transform="translate(-155.46222 -220.31024)" fill="#6c63ff"/><circle cx="667.45062" cy="109.66168" r="2.30677" fill="#e6e6e6"/><circle cx="692.05622" cy="109.66168" r="2.30677" fill="#e6e6e6"/><path d="M388.8876,463.362c.56134.0077,1.12264.01539,1.69164.01539s1.1303-.00769,1.69164-.01539c29.75741-.67666,51.32574-19.26926,45.83561-38.77688l-13.387-47.58877L421.33624,364.955l-59.97615,1.02264-3.64469,11.77994-14.34817,46.36621C337.29275,443.739,358.86109,462.68533,388.8876,463.362Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M357.7154,377.75757a66.201,66.201,0,0,0,67.00413-.76123L421.33624,364.955l-59.97615,1.02264Z" transform="translate(-155.46222 -220.31024)" opacity="0.2"/><path d="M352.962,420.52381c-6.47349-7.6187-20.13012-16.56472-48.90033-21.5257-50.17744-8.65585-37.1209-39.13943-36.54168-40.43193,1.21524-2.71115-.01371-4.52748-2.77131-4.04135a11.22369,11.22369,0,0,0-7.26561,5.7663c-.74147,1.58513-17.492,38.90987,39.12707,48.67275,50.95721,8.79036,51.139,30.19031,51.12548,30.40285-.13567,2.36221,2.21806,3.08656,5.26252,1.62046s5.62513-4.5691,5.76494-6.93088C358.79137,433.55727,358.98968,427.61576,352.962,420.52381Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M418.26054,470.29771a6.92018,6.92018,0,0,0,6.92032-6.92033V433.38931a6.92033,6.92033,0,0,0-13.84065,0v29.98807A6.92019,6.92019,0,0,0,418.26054,470.29771Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M412.19286,399.10463a6.92019,6.92019,0,0,0,9.17934,3.39434l27.243-12.53415a6.92033,6.92033,0,1,0-5.785-12.57368l-27.243,12.53415A6.92019,6.92019,0,0,0,412.19286,399.10463Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M368.96562,399.10463a6.92019,6.92019,0,0,1-9.17934,3.39434l-27.243-12.53415a6.92033,6.92033,0,1,1,5.785-12.57368l27.243,12.53415A6.92019,6.92019,0,0,1,368.96562,399.10463Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M362.898,470.29771a6.92018,6.92018,0,0,1-6.92032-6.92033V433.38931a6.92033,6.92033,0,0,1,13.84065,0v29.98807A6.92019,6.92019,0,0,1,362.898,470.29771Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M445.94662,274.22073a6.8438,6.8438,0,0,0,.30144-3.47373l-3.76639-22.157-3.76639-22.157a6.913,6.913,0,0,0-11.22614-4.16442l-17.30532,14.34029L400.14091,244.931a65.69368,65.69368,0,0,0-21.04716.31735l-10.42587-8.63951-17.30531-14.34029a6.913,6.913,0,0,0-11.22615,4.16442L336.37,248.59l-3.76639,22.157a6.80563,6.80563,0,0,0,1.3735,5.40838,66.13684,66.13684,0,1,0,111.96948-1.93465Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M427.05136,232.14011,406.06587,249.5299l-.00038.00075a3.42226,3.42226,0,0,0,.99345,5.84353l25.55324,9.4794a3.4226,3.4226,0,0,0,4.56474-3.7823l-4.56737-26.86957a3.38792,3.38792,0,0,0-2.18438-2.63529,3.44677,3.44677,0,0,0-1.20182-.21814A3.3922,3.3922,0,0,0,427.05136,232.14011Z" transform="translate(-155.46222 -220.31024)" fill="#e6e6e6"/><path d="M348.42654,231.56642a3.38788,3.38788,0,0,0-2.18438,2.63529l-4.56737,26.86957a3.4226,3.4226,0,0,0,4.56474,3.7823l25.55324-9.4794a3.42227,3.42227,0,0,0,.99344-5.84353l-20.98587-17.39054a3.39218,3.39218,0,0,0-2.172-.79183A3.44672,3.44672,0,0,0,348.42654,231.56642Z" transform="translate(-155.46222 -220.31024)" fill="#e6e6e6"/><circle cx="235.11702" cy="99.27819" r="9.2271" fill="#e6e6e6"/><ellipse cx="235.11702" cy="94.66464" rx="6.1514" ry="2.30677" fill="#3f3d56"/><path d="M390.9637,324.9709h0A4.22908,4.22908,0,0,1,395.19279,329.2v10.38049a0,0,0,0,1,0,0h-8.45817a0,0,0,0,1,0,0V329.2A4.22908,4.22908,0,0,1,390.9637,324.9709Z" transform="translate(626.46519 444.24113) rotate(-180)" fill="#ff6584"/><path d="M390.06586,220.31024c.4435.91976.87414,1.84947,1.27916,2.79819a65.81819,65.81819,0,0,1,4.65081,35.34385c-.86574-1.25608-1.77555-2.56471-2.701-3.88776A65.775,65.775,0,0,0,390.06586,220.31024Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M383.14553,228.76841c.44351.91977.87415,1.84948,1.27917,2.7982a65.81827,65.81827,0,0,1,4.65081,35.34384c-.86574-1.25607-1.77556-2.56471-2.701-3.88776A65.77493,65.77493,0,0,0,383.14553,228.76841Z" transform="translate(-155.46222 -220.31024)" fill="#3f3d56"/><path d="M361.80966,260.25756l.97489-12.39806.97489-12.39808a3.82528,3.82528,0,0,1,5.98-2.85281l10.24962,7.04332,7.48459,5.14325a5.09539,5.09539,0,0,1,7.74913,0l7.48459-5.14325,10.24962-7.04332a3.82528,3.82528,0,0,1,5.98,2.85281l.97489,12.39808.97489,12.39806a3.82528,3.82528,0,0,1-5.46059,3.75239L404.2016,258.6552l-9.22264-4.39977a5.10114,5.10114,0,0,1-7.26159,0l-9.22264,4.39977L367.27025,264.01A3.82528,3.82528,0,0,1,361.80966,260.25756Z" transform="translate(-155.46222 -220.31024)" fill="#6c63ff"/><path d="M400.57526,309.5924c0,1.274,1.03278,0,2.30678,0s2.30677,1.274,2.30677,0a2.30678,2.30678,0,0,0-4.61355,0Z" transform="translate(-155.46222 -220.31024)" fill="#e6e6e6"/><path d="M380.58322,309.5924c0,1.274-1.03278,0-2.30678,0s-2.30677,1.274-2.30677,0a2.30678,2.30678,0,0,1,4.61355,0Z" transform="translate(-155.46222 -220.31024)" fill="#e6e6e6"/><polygon points="481.05 263.451 481.05 248.788 407.736 248.788 407.736 249.705 407.736 263.451 407.736 381.67 407.736 396.333 422.399 396.333 481.05 396.333 481.05 381.67 422.399 381.67 422.399 263.451 481.05 263.451" fill="#3f3d56"/><path d="M672.25275,469.09857V616.643h73.314V469.09857Zm58.65118,132.8816h-43.9884V483.76142h43.9884Z" transform="translate(-155.46222 -220.31024)" fill="#6c63ff"/><polygon points="313.344 381.67 313.344 249.705 298.681 249.705 298.681 381.67 298.681 396.333 313.344 396.333 371.995 396.333 371.995 381.67 313.344 381.67" fill="#6c63ff"/><polygon points="265.69 263.451 265.69 248.788 192.376 248.788 192.376 249.705 192.376 263.451 192.376 314.771 192.376 329.434 192.376 381.67 192.376 396.333 207.039 396.333 265.69 396.333 265.69 381.67 207.039 381.67 207.039 329.434 265.69 329.434 265.69 314.771 207.039 314.771 207.039 263.451 265.69 263.451" fill="#3f3d56"/><polygon points="839.372 263.451 839.372 248.788 766.058 248.788 766.058 249.705 766.058 263.451 766.058 314.771 766.058 329.434 766.058 381.67 766.058 396.333 780.721 396.333 839.372 396.333 839.372 381.67 780.721 381.67 780.721 329.434 839.372 329.434 839.372 314.771 780.721 314.771 780.721 263.451 839.372 263.451" fill="#6c63ff"/><polygon points="142.889 249.705 142.889 370.89 104.228 332.23 104.14 332.319 104.058 332.237 64.535 371.76 64.535 249.247 49.872 249.247 49.872 395.875 64.535 395.875 64.535 392.496 104.147 352.884 142.889 391.627 142.889 396.333 157.552 396.333 157.552 249.705 142.889 249.705" fill="#3f3d56"/><polygon points="717.488 249.705 717.488 253.083 677.876 292.695 639.133 253.953 639.133 249.247 624.47 249.247 624.47 395.875 639.133 395.875 639.133 274.689 677.794 313.35 677.883 313.261 677.964 313.342 717.488 273.819 717.488 396.333 732.15 396.333 732.15 249.705 717.488 249.705" fill="#3f3d56"/><circle cx="335.07556" cy="150.37952" r="9" fill="#6c63ff"/><circle cx="113.07556" cy="250.37952" r="9" fill="#6c63ff"/><circle cx="291.07556" cy="450.37952" r="9" fill="#6c63ff"/><circle cx="517.07556" cy="177.37952" r="9" fill="#6c63ff"/><circle cx="782.07556" cy="442.37952" r="9" fill="#6c63ff"/><circle cx="791.07556" cy="206.37952" r="9" fill="#6c63ff"/><circle cx="677.07556" cy="368.37952" r="9" fill="#6c63ff"/></svg></div>';
            }
            ?>
        </div>
    </div>
    <div class="d-lg-none condent2">
        <canvas id="particles"></canvas>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="300" height="300"
            viewBox="0 0 825.85001 506.44001">
            <path
                d="m438.22,378.66001c-1.76999,10.70999-11.09,18.91-22.29001,18.91s-20.53-8.20001-22.29001-18.91h-57.04001v123.61002h158.66v-123.60999h-57.04001l.00003-.00003Z"
                fill="#d9d9d9" stroke-width="0" />
            <rect x="339.36" y="501.81" width="15.68001" height="2.76999" fill="#b6b3c5" stroke-width="0" />
            <rect x="478.19" y="502.26999" width="15.67999" height="2.76999" fill="#b6b3c5" stroke-width="0" />
            <path
                d="m735.01001,381.89002H96.85c-4.88,0-8.85-3.97-8.85-8.85001V8.85c0-4.88,3.97-8.85,8.85-8.85h638.15995c4.88,0,8.84998,3.97,8.84998,8.85v364.20002c0,4.88-3.96997,8.85001-8.84998,8.85001h0l.00006-.01001Z"
                fill="#2f2e41" stroke-width="0" />
            <rect x="104.14" y="15.68" width="624.49001" height="352.36999" fill="#fff" stroke-width="0" />
            <path
                d="m0,505.53c0,.5.39999.91.91.91h824.03c.5,0,.91-.39999.91-.91s-.39999-.91-.91-.91H.91c-.5,0-.91.39999-.91.91Z"
                fill="#2f2e43" stroke-width="0" />
            <rect x="452.85547" y="162.80304" width="171" height="15.50007" rx="7.75002" ry="7.75002" fill="#63d1ff"
                stroke-width="0" />
            <rect x="486.35547" y="225.80304" width="137.5" height="15.50007" rx="7.75002" ry="7.75002" fill="#63d1ff"
                stroke-width="0" />
            <rect x="585.35547" y="266.80303" width="38.5" height="15.50007" rx="7.75002" ry="7.75002" fill="#63d1ff"
                stroke-width="0" />
            <rect x="252.85547" y="205.80299" width="131.5" height="15.50007" rx="7.75002" ry="7.75002" fill="#cacacb"
                stroke-width="0" />
            <rect x="252.85547" y="245.80298" width="49.5" height="15.50007" rx="7.75003" ry="7.75003" fill="#cacacb"
                stroke-width="0" />
            <rect x="497.35547" y="184.80299" width="126.5" height="15.50007" rx="7.75002" ry="7.75002" fill="#63d1ff"
                stroke-width="0" />
            <line x1="243.85547" y1="110.80311" x2="632.85547" y2="110.80311" fill="none" stroke="#000"
                stroke-miterlimit="10" stroke-width="2" />
            <line x1="256.35547" y1="97.30311" x2="341.62376" y2="97.30311" fill="none" stroke="#000"
                stroke-miterlimit="10" stroke-width="2" />
            <polygon
                points="133.90734 266.95399 127.08699 293.90612 174.18238 293.32469 168.79281 268.69826 133.90734 266.95399"
                fill="#ec9c9f" stroke-width="0" />
            <polygon
                points="125.19564 359.03605 114.9706 403.77063 96.15131 493.33475 104.87267 495.07903 164.8177 361.59231 125.19564 359.03605"
                fill="#ec9c9f" stroke-width="0" />
            <polygon
                points="144.88194 369.22618 163.76862 411.04756 191.50494 495.07903 203.13343 492.17191 177.9956 347.31894 144.88194 369.22618"
                fill="#ec9c9f" stroke-width="0" />
            <path
                d="m129.73176,282.80932s-21.0265,37.02558-17.19211,77.92577c0,0,30.99861,23.4725,80.79675,1.74427l-20.49905-81.80038-43.10559,2.13034Z"
                fill="#090814" stroke-width="0" />
            <path
                d="m94.6951,504.01361c-1.00113-.8206-1.54155-1.73691-1.60613-2.72359-.07391-1.12857.4838-2.33945,1.65737-3.59899.02817-.36244.39241-4.8529,1.20407-5.657-.06804-.24037-.48147-1.83392.19625-2.86866.31927-.48742.83388-.77152,1.52958-.84442l.03031-.00313.01502.02682c.01962.03507,1.99467,3.50875,4.96562,3.81373,1.7033.17484,3.40864-.71249,5.0687-2.63806.05967-.14226.52872-2.4876.83146-4.04004l.01211-.06207,16.18785,8.61544,9.46241,2.65115c1.18928.33323,2.01988,1.43857,2.01988,2.68802,0,1.06539-.61278,2.05207-1.56112,2.51364l-4.58661,2.2324c-1.9165.93281-4.05348,1.42585-6.17995,1.42585h-24.87937c-1.61191,0-3.16297-.54373-4.36745-1.53106Z"
                fill="#090814" stroke-width="0" />
            <path
                d="m187.14161,504.01361c-1.00113-.8206-1.54155-1.73691-1.60613-2.72359-.07391-1.12857.4838-2.33945,1.65737-3.59899.02817-.36244.39241-4.8529,1.20407-5.657-.06804-.24037-.48147-1.83392.19625-2.86866.31927-.48742.83388-.77152,1.52958-.84442l.03031-.00313.01502.02682c.01962.03507,1.99467,3.50875,4.96562,3.81373,1.7033.17484,3.40864-.71249,5.0687-2.63806.05967-.14226.52872-2.4876.83146-4.04004l.01211-.06207,16.18785,8.61544,9.46241,2.65115c1.18928.33323,2.01988,1.43857,2.01988,2.68802,0,1.06539-.61278,2.05207-1.56112,2.51364l-4.58661,2.2324c-1.9165.93281-4.05348,1.42585-6.17995,1.42585h-24.87937c-1.61191,0-3.16297-.54373-4.36745-1.53106Z"
                fill="#090814" stroke-width="0" />
            <path
                d="m140.67445,183.31593c0-10.49112,8.50475-18.99588,18.99588-18.99588,10.49119,0,18.99595,8.50475,18.99595,18.99588,0,8.50837-5.59422,15.70925-13.30477,18.12757l-3.67223,24.26908-18.72057-15.60045s4.04421-5.15134,6.21305-10.95977c-5.12608-3.40182-8.50731-9.22316-8.50731-15.83644Z"
                fill="#ec9c9f" stroke-width="0" />
            <path
                d="m141.18623,202.06797l22.37376,14.30207,10.32709,18.23765c2.99019,5.28068,4.00009,11.45432,2.84839,17.41254l-4.74482,24.54687h-49.47121s7.81675-51.21249,7.81675-51.21249c.99768-6.53645,3.48735-12.75532,7.27598-18.17443l3.57406-5.11221Z"
                fill="#63d1ff" stroke-width="0" />
            <path
                d="m134.57531,208.27449s.88705,6.72999,9.10548,6.94977q16.67112.44582,16.67112.44582s-14.09285-34.29671-8.29807-30.43294c5.79478,3.86377,21.24752-12.33435,21.24752-12.33435l4.55958,8.55144s10.89316-3.94464-1.17929-13.60407c0,0-14.40418-11.13618-29.69595-4.44888s-12.41039,44.87321-12.41039,44.87321Z"
                fill="#090814" stroke-width="0" />
            <rect x="70.35547" y="343.30311" width="167" height="37" fill="#cacacb" stroke-width="0" />
            <circle cx="90.40085" cy="361.18262" r="11" fill="none" stroke="#000" stroke-miterlimit="10"
                stroke-width="2" />
            <line x1="105.40085" y1="352.18262" x2="170.67007" y2="352.18262" fill="none" stroke="#000"
                stroke-miterlimit="10" stroke-width="2" />
            <line x1="105.40085" y1="361.18262" x2="219.27449" y2="361.18262" fill="none" stroke="#000"
                stroke-miterlimit="10" stroke-width="2" />
            <line x1="105.40085" y1="368.49799" x2="228.99537" y2="368.49799" fill="none" stroke="#000"
                stroke-miterlimit="10" stroke-width="2" />
            <path
                d="m145.01414,330.14192l-.39938-18.40908,10.74845-.23318.39938,18.40908c2.00539,1.86164,3.32919,4.75425,3.40034,8.03381.12449,5.73837-3.62437,10.47369-8.37335,10.57671-4.74898.10303-8.69968-4.46525-8.82417-10.20362-.07115-3.27955,1.12605-6.22686,3.04873-8.17371Z"
                fill="#ec9c9f" stroke-width="0" />
            <polyline points="159.85302 238.00363 159.85302 327.23411 141.18623 327.23411 135.66941 238.75686"
                fill="#63d1ff" stroke-width="0" />
        </svg>
        <h3 class="p-0 m-0">Please Open in Desktop</h3>

    </div>
    <script src="./particals/particles.js"></script>
    <script>
    // logout yes or no button 
    document.addEventListener('DOMContentLoaded', function () {
      var logout = document.getElementById('logout');
      logout.addEventListener('click', function () {
        var button = confirm("Do you want to logout.....!");
        if (button) {
          window.location.href = "admin.php?logout";
        }
      });
    });
  </script>
</body>

</html>