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
  <!-- bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <style>
    *::-webkit-scrollbar {
      display: none;
    }

    /* user in navbar */
    .user-name {
      display: none;
    }

    /* user-name display in mobile and tab screen */
    @media screen and (max-width:991px) {
      .user-name {
        display: inline;
      }
    }

    /* secondary nav bar hide in mobile and tab screen */
    @media screen and (max-width: 991px) {

      .secondary-navbar {
        display: none;
      }
    }

    /* product card des */
    .product-scale {
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    body {
      font-family: Calibri, serif;
    }

    /* aero cursor  */
    p,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .secondary_navbar {
      cursor: default;
    }
  </style>
</head>

<body>

  <?php
  session_start();
  // database connection
  include 'database.php';
  // code for favoruit  
  include 'fav.php';
  // code for product
  include 'product.php';
  ?>
  <header class="sticky-top">
    <div class="container-fluid  p-0" style="background-color: #03a9f4;">
      <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
          <!-- logo  image-->
          <p class="display-6"><img class="logo" src="../website/image/1000005311-removebg-preview.png">
            <!-- title -->
            <b class="title">Food World</b>
          </p>
          <!-- menu-button -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
          </button>
          <!-- menu-item -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <!-- user name -->
              <li class="nav-item">
                <h4 class="user-name">Welcome&nbsp;<?php if (isset($_SESSION['user_name']/*referance in login_logout.php*/)) {
                  echo $_SESSION['user_name'];
                } else {
                  echo "Gust";
                } ?></h4>
              </li>
              <!-- Home -->
              <li class="nav-item">
                <a class="nav-link active " aria-current="page" href="Food World.php">Home</a>
              </li>
              <!-- Favorite -->
              <li class="nav-item">
                <a class="nav-link active " href="second page.php?favorite"><i class="fa-regular fa-heart"
                    title="Favorite"></i><sup><?php num_card();/*this function present in fav.php page*/ ?></sup></a>
              </li>
              <!-- my order -->
              <li class="nav-item">
                <a class="nav-link active " aria-current="page" href="second page.php?order">My Order</a>
              </li>
              <!-- about -->
              <li class="nav-item">
                <a class="nav-link active" href="#">About</a>
              </li>
              <!-- login and logout -->
              <li class="nav-item">
                <?php if (!isset($_SESSION['user_id']/*referance in login_logout.php*/)) {
                  echo "<a class='nav-link active' href='login_logout.php?login'>Login</a>";
                } else {
                  echo "<a class='nav-link active' id ='logout' style='cursor: pointer;'>Logout</a>";
                }
                ?>
              </li>
              <!-- admin page -->
              <li class="nav-item">
                <a class="nav-link active" href="./admin/admin.php"><!--Admin page --><i
                    class="fa-solid fa-user-tie"></i></a>
              </li>
            </ul>
          </div>
          <!-- search product -->
          <form class="col-12 sm-12 col-lg-2 mt-2 mt-lg-0 d-flex " role="search" action="second page.php" method="get">
            <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="user_serch"
              required>
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </div>
    <!-- secondary-navbar -->
    <nav class="navbar navbar-expand bg-secondary secondary-navbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active secondary_navbar" aria-current="page" href="#">Welcome&nbsp;<?php if (isset($_SESSION['user_name']/*referance in login_logout.php*/)) {
            echo $_SESSION['user_name'];
          } else {
            echo "Gust";
          } ?></a>
        </li>

      </ul>
    </nav>
  </header>
  <div class="container-fluid">
    <div class="row">
      <!-- product -->
      <div class="col-7 col-sm-8 col-lg-10">
        <div class="row">
          <!-- display dynamic product -->
          <?php
          all_product();
          ?>
        </div>
      </div>
      <!-- Categories-navbar -->
      <div class="col-5 col-sm-4 col-lg-2 " align="right">
        <div class="container-fluid bg-secondary mt-2 p-0 h-100">
          <!-- Categories-navbar title -->
          <h4 align="center" class="bg-info p-2"><b>Food Categories</b></h4>
          <!-- Categories-navbar item -->
          <ul class="navbar-nav">
            <?php
            $select_cat = "SELECT * FROM categories";
            $result = mysqli_query($con, $select_cat);
            while ($row = mysqli_fetch_array($result)) {
              $pay_id = $row['cat_id'];
              $pay_type = $row['cat_title'];
              echo "<li class='nav-item'><a class='nav-link active text-center text-white' aria-current='page' href='second page.php?cat=$pay_type'>$pay_type</a></li>";
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <footer class="mt-3">
    <div class="bg-info p-3">
      <p align="center">All right reserved - Designed by Harish-2024</p>
    </div>
  </footer>
  <script>
    // logout yes or no button 
    document.addEventListener('DOMContentLoaded', function () {
      var logout = document.getElementById('logout');
      logout.addEventListener('click', function () {
        var button = confirm("Do you want to logout.....!");
        if (button) {
          window.location.href = "login_logout.php?logout";
        }
      });
    });
  </script>
</body>

</html>