<?php
function insert_product()
{
?>
<!-- heading -->
<h4 align="center"><b>Insert Product</b></h4>
<form action="" method="post" class="mb-2" enctype="multipart/form-data">
  <!-- product name -->
  <div class="form-outline m-3">
    <label for="product name" class="form-label">Product Name</label>
    <input type="text" class="form-control w-50" name="product_name" placeholder="Enter Product Name" autocomplete="off"
      required="required">
  </div>
  <!-- product scale -->
  <div class="form-outline m-3">
    <label for="product Keyword" class="form-label">Product Scale</label>
    <input type="text" class="form-control w-50" name="product_scale" placeholder="Enter Product Scale"
      autocomplete="off" required="required">
  </div>
  <!-- product description -->
  <div class="form-outline m-3">
    <label for="product Keyword" class="form-label">Product Description</label>
    <input type="text" class="form-control w-50" name="product_des" placeholder="Enter Product Description"
      autocomplete="off" required="required">
  </div>
  <!-- product keyword -->
  <div class="form-outline m-3">
    <label for="product Keyword" class="form-label">Product Keyword</label>
    <input type="text" class="form-control w-50" name="product_keyword" placeholder="Enter Product Keyword"
      autocomplete="off" required="required">
  </div>
  <!-- product categories -->
  <div class="form-outline  m-3">
    <label for="product Categories" class="form-label">Product Categories</label>
    <select name="product_cat" class="form-select w-50" required>
      <option value="">-Select Categories-</option>
      <?php
      // database connection
      include './../database.php';
      $select_cat = "SELECT * FROM categories";
      $result = mysqli_query($con, $select_cat);
      while ($row = mysqli_fetch_array($result)) {
        $cat = $row['cat_title'];
        echo "<option value='$cat'>$cat</option>";
      }
      ?>
    </select>
  </div>
  <!-- product image -->
  <div class="form-outline m-3">
    <label for="product Image" class="form-label">Product Image</label>
    <input type="file" class="form-control w-50" name="product_img" required="required">
  </div>
  <!-- product image2 -->
  <div class="form-outline m-3">
    <label for="product Image2" class="form-label">Product Image 2</label>
    <input type="file" class="form-control w-50" name="product_img2" required="required">
  </div>
  <!-- product image3 -->
  <div class="form-outline m-3">
    <label for="product Image3" class="form-label">Product Image3</label>
    <input type="file" class="form-control w-50" name="product_img3" required="required">
  </div>
  <!-- product Stock-->
  <div class="form-outline m-3">
    <label for="product stock" class="form-label">Product Stock</label>
    <input type="number" class="form-control w-50" name="product_stock" placeholder="Enter Product Stock"
      autocomplete="off" required="required">
  </div>
  <!-- product price -->
  <div class="form-outline m-3">
    <label for="product Keyword" class="form-label">Product Price</label>
    <input type="number" class="form-control w-50" name="product_Price" placeholder="Enter Product Price"
      autocomplete="off" required="required">
  </div>
  <!-- product off-->
  <div class="form-outline m-3">
    <label for="product Off" class="form-label">Product Off</label>
    <input type="number" class="form-control w-50" name="product_off" placeholder="Enter Product Off" autocomplete="off"
      required="required">
  </div>
  <!-- submit button -->
  <div class="form-outline w-10 m-3">
    <input type="submit" name="submit" class="btn btn-info" value="Insert Product">
  </div>
</form>
<!-- code for insert product into database -->
<?php
if (isset($_POST['submit'])) {
  if(isset($_SESSION['login']))
{
  $product_name = $_POST['product_name'];
  $product_des = $_POST['product_des'];
  $product_scale = $_POST['product_scale'];
  $product_keyword = $_POST['product_keyword'];
  $product_cat = $_POST['product_cat'];
  $product_stock=$_POST['product_stock'];
  $product_price = $_POST['product_Price'];
  $product_off = $_POST['product_off'];
  // to fint current price
  $offer = 100 - $_POST['product_off'];
  $product_c_price = round(($product_price / 100) * $offer);
  // code for image uplode into database
  $img_name = $_FILES['product_img']['name'];
  $tmp_name = $_FILES['product_img']['tmp_name'];
  move_uploaded_file($tmp_name, "product_image/$img_name");
  $img_name2 = $_FILES['product_img2']['name'];
  $tmp_name2 = $_FILES['product_img2']['tmp_name'];
  move_uploaded_file($tmp_name2, "product_image/$img_name2");
  $img_name3 = $_FILES['product_img3']['name'];
  $tmp_name3 = $_FILES['product_img3']['tmp_name'];
  move_uploaded_file($tmp_name3, "product_image/$img_name3");
  // select qry for already exists or not
  $result_select = "SELECT * FROM product WHERE product_name='$product_name'";
  $number = mysqli_query($con, $result_select);
  // to check already exists or not
  $result = mysqli_num_rows($number);
  if ($result > 0) {
    echo "<script>alert('$product_name is alredy inserted into product')</script>";
  } else {
    // code for insert data in database
    $insert_qry = "INSERT INTO product(	product_name,product_scale,product_des,product_keyword,product_cat,product_img,product_img2,product_img3,product_stock,product_price,product_off,product_c_price)VALUE
    ('$product_name','$product_scale','$product_des','$product_keyword','$product_cat','$img_name','$img_name2','$img_name3','$product_stock','$product_price','$product_off','$product_c_price')";
    $result = mysqli_query($con, $insert_qry);
    if ($result) {
      echo "<script>alert('Successfully product data is inserted into Product')</script>";
    }
  }
}
else
{
    echo "<script>window.location.href='admin.php?login';</script>";
}
}
}
?>