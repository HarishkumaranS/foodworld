<style>
  #disabled {
    cursor: not-allowed;
  }

  .out_stock {
    color: red;
  }

  #blur {

    filter: grayscale(100%) blur(1px);
  }
  @media screen and (max-width: 768px) {
    #img{
      margin-left: 12px;
    }
  }
  .releated_p_des {
            width: 150px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
</style>
<?php
if (isset($_GET['view'])) {
  $product_id = $_GET['view'];
  $select_qry = "SELECT * FROM product WHERE product_id=$product_id";
  $result_select = mysqli_query($con, $select_qry);
  $row = mysqli_fetch_array($result_select);
  $product_stock = $row['product_stock'];
  // to display view more product  
  function view_more()
  {
    global $product_id, $product_stock,$con;
    $select_qry = "SELECT * FROM product WHERE product_id=$product_id";
    $result_select = mysqli_query($con, $select_qry);
    $row = mysqli_fetch_array($result_select);
    ?>
    <!-- product image -->
    <div class="col-11 col-md-12 col-lg-3" id="img">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block  w-100 view_image" src='./admin/product_image/<?php echo $row['product_img']; ?>'
              alt="First slide" height="225px" <?php if ($row['product_stock'] <= 0) {
                echo 'id="blur"';
              } ?>>
          </div>
          <div class="carousel-item">
            <img class="d-block  w-100 view_image" src="./admin/product_image/<?php echo $row['product_img2']; ?>"
              alt="Second slide" height="225px" <?php if ($row['product_stock'] <= 0) {
                echo 'id="blur"';
              } ?>>
          </div>
          <div class="carousel-item">
            <img class="d-block  w-100 view_image" src="./admin/product_image/<?php echo $row['product_img3']; ?>"
              alt="Third slide" height="225px" <?php if ($row['product_stock'] <= 0) {
                echo 'id="blur"';
              } ?>>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only ">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <div class="col-12 col-md-12 col-lg-4">
      <!-- product name -->
      <h4><?php echo $row['product_name']; ?></h4>
      <!-- product scale -->
      <p><?php echo $row['product_scale']; ?></p>
      <!-- product price -->
      <p>
        <del>₹<?php echo $row['product_price']; ?></del>&nbsp;&nbsp;<b>₹<?php echo $row['product_c_price']; ?></b>&nbsp;&nbsp;<b
          class="text-white bg-success px-2"><?php echo $row['product_off']; ?>%</b>
      </p>
      <!-- prosduct des -->
      <h6><b>Product Description :</b></h6>
      <p class="view_des p-0 m-0">
        <?php echo $row['product_des']; ?>
      </p>
      <!-- read more and less -->
      <a href="#" class="read-more-btn nav-link p-0 m-0" style="display:inline;">Read More</a>
      <a href="#" class="read-less-btn nav-link p-0 m-0" style="display:none;">Read Less</a>
    </div>
    <div class="col-12">
      <!-- releated product -->
      <h6><b>Realeted Products</b></h6>

      <ul class="releated_product d-flex">
        <?php
        // select releated cat
        $cat_name = $row['product_cat'];
        $select_qry = "SELECT * FROM product WHERE product_cat='$cat_name' and product_id !=$product_id ORDER BY rand()";
        $result_qry = mysqli_query($con, $select_qry);
        while ($row_c = mysqli_fetch_array($result_qry)) {
          ?>
          <li class="releated_p_item">
            <div>
              <div class='card p-0 m-0'>
                <a href='second page.php?view=<?php echo $row_c['product_id']; ?>'> <img
                    src='./admin/product_image/<?php echo $row_c['product_img']; ?>' height="100" width="150"
                    style="object-fit:contain;" align="center" <?php if ($row_c['product_stock'] <= 0) {
                      echo 'id="blur"';
                    } ?>></a>
                <div class='card-body p-0 m-0'>
                  <p class="pl-1 m-0"><b class="releated_p_des"><?php echo $row_c['product_name']; ?></b></p>
                  <p class="p-0 m-0 releated_p_des"><?php echo $row_c['product_scale']; ?></p>
                  <p class='card-text pl-1 m-0' style='color: green;'><?php echo $row_c['product_off']; ?>% off &nbsp;<del
                      style='color: black;'><?php echo $row_c['product_price']; ?></del>&nbsp;<b
                      style='color: black;'><?php echo $row_c['product_c_price']; ?></b></p>
                </div>
              </div>
            </div>
          </li>
        <?php }
        ?>
      </ul>
      <a href="second page.php?releated_product=<?php echo $cat_name; ?>"
        class="nav-link p-0 m-0 d-flex justify-content-end">View all</a>
    </div>


    <!-- qty and price -->
    <?php
    // user id
    $user_id = null;
    if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
    }
    // display price and discound
    if ($product_stock > 0) {

      //  select fav table 
      $select_qry = "SELECT * FROM fav where user_id='$user_id' and product_id=$product_id";
      $result_qry = mysqli_query($con, $select_qry);
      $num = mysqli_num_rows($result_qry);
      if ($num == 1) {
        //  fav table row
        $row_f = mysqli_fetch_array($result_qry);
        $fav_id = $row_f['product_id'];
        ?>
        <!-- fav table -->
        <div class="col-12">
          <table>
            <tr>
              <th class='p-2'>
                Price
              </th>
              <th>
                <spam id="product_price"><?php echo $row_f['fav_p_price']; ?></spam>/-
              </th>
            </tr>
            <tr>
              <th class='p-2'>
                Discound
              </th>
              <th class='text-success'>-
                <spam id="product_discount"><?php echo $row_f['fav_p_price'] - $row_f['fav_c_price']; ?></spam>
                /-
              </th>
            </tr>
            <tr>
              <th class='p-2'>
                Total Amount
              </th>
              <th>
                <spam id="total_price"><?php echo $row_f['fav_c_price']; ?></spam>/-
              </th>
            </tr>
            <tr>
              <th class='p-2'>
                Quantity
              </th>
              <th>
                <div class='quantity'>
                  <a href='second page.php?vdec_id=<?php echo $fav_id; ?>' class='dec'><i
                      class='fa-solid fa-circle-minus'></i></a>
                  <span><?php echo $row_f['qty']; ?></span>
                  <a href='second page.php?vinc_id=<?php echo $fav_id ?>' class='inc'><i class='fa-solid fa-circle-plus'></i><a>
                </div>
              </th>
            </tr>
          </table>
        </div>
        <?php
      } else { ?>
        <!-- view details -->
        <?php
                     if(!isset($_SESSION['cart'][$product_id]['quantity']) || $_SESSION['cart'][$product_id]['quantity']==0)
                    {
                     $_SESSION['cart'][$product_id] = ['productId' => $product_id,'quantity' => 1];
                    }
                    if($_SESSION['cart'][$product_id]['quantity'] <= $row['product_stock'])
                    {
                      $qty= $_SESSION['cart'][$product_id]['quantity'];
                    }
                    else{
                      $_SESSION['cart'][$product_id] = ['productId' => $product_id,'quantity' => $row['product_stock'] ];
                      $qty = $_SESSION['cart'][$product_id]['quantity'];
                    }
                    ?>
        <div class="col-12">
          <table>
            <tr>
              <th class='p-2'>
                Price
              </th>
              <th>
                <spam id="product_price"><?php echo $row['product_price']*$qty; ?></spam>/-
              </th>
            </tr>
            <tr>
              <th class='p-2'>
                Discound
              </th>
              <th class='text-success'>-
                <spam id="product_discount"><?php echo ($row['product_price'] - $row['product_c_price'])*$qty; ?></spam>
                /-
              </th>
            </tr>
            <tr>
              <th class='p-2'>
                Total Amount
              </th>
              <th>
                <spam id="total_price"><?php echo $row['product_c_price']*$qty; ?></spam>/-
              </th>
            </tr>
            <tr>
              <th class='p-2'>
                Quantity
              </th>
              <th>
                <div class='quantity'>
                  <a href='second page.php?dec_view=<?php echo $product_id; ?>' class='dec'><i class='fa-solid fa-circle-minus'></i></a>
                  <span id="count">
                  <?php echo $qty; ?>
                  </span>
                  <a href='second page.php?inc_view=<?php echo $product_id; ?>' class='inc'><i
                      class='fa-solid fa-circle-plus'></i></a>
                </div>
              </th>
            </tr>

          </table>
        </div>
        <?php
      }
    } else {
      echo "<h3 class='out_stock'>Out of stock";
    }
  }
}
// Fav btn and order btn
function view_fooder()
{
  global $product_id, $product_stock;
  ?>
  <footer class="bg-light" style="text-align:center; margin:0.5rem;">
    <a href='second page.php?view=<?php echo $product_id; ?> && fav=<?php echo $product_id; ?>'
      class='btn btn-secondary me-2'><?php echo heart($product_id); ?>Add to Favorite</a>&nbsp;&nbsp;&nbsp;

    <a <?php if ($product_stock > 0) {
      echo "href='second page.php?order_product=$product_id'";
    } ?>
      class="btn btn-warning me-2 p-2" <?php if ($product_stock <= 0) {
        echo 'id="disabled"';
      } ?>>Place Order</a>

  </footer>
  <?php
}

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
//increment
// Function to add a product to the cart or increase quantity
if (isset($_GET['inc_view'])) {
  $productId = $_GET['inc_view'];
  $select_qry = "SELECT product_stock FROM product WHERE product_id=$productId";
  $result_select = mysqli_query($con, $select_qry);
  $row = mysqli_fetch_array($result_select);
  $product_stock = $row['product_stock'];
  if (isset($_SESSION['cart'][$productId]['quantity'])) {
    if ($_SESSION['cart'][$productId]['quantity'] < $product_stock) {        
    $_SESSION['cart'][$productId]['quantity']++;
    }
    echo "<script> window.history.back();</script>";
  }
 
}
if(isset($_GET['dec_view']))
{
  $productId=$_GET['dec_view'];
  if (isset($_SESSION['cart'][$productId]['quantity'])) {         
    if ($_SESSION['cart'][$productId]['quantity'] > 1) {             
        // Decrease the quantity by 1             
        $_SESSION['cart'][$productId]['quantity']--;         
    }  
} 
echo "<script> window.history.back();</script>";
}
?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var readMoreBtn = document.querySelector('.read-more-btn');
    var readLessBtn = document.querySelector('.read-less-btn');
    var paragraph = document.querySelector('.view_des');

    readMoreBtn.addEventListener('click', function () {
        readMoreBtn.style.display='none';
        readLessBtn.style.display='inline';
      paragraph.style.webkitBoxOrient='horizontal';
    });

    readLessBtn.addEventListener('click', function () {
        readMoreBtn.style.display='inline';;
        readLessBtn.style.display='none';
      paragraph.style.webkitBoxOrient='vertical';
    });
  });
</script>