<?php
function insert_cat()
{
?>
<!-- heading -->
<h4 align="center"><b>Insert Categories</b></h4>
<form action="" method="post" class="mb-2">
  <!-- input for  Categories title -->
  <div class="input-group w-90 m-3">
    <!-- icons -->
    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
    <!-- text field -->
    <input type="text" class="form-control" name="cat_title" placeholder="Insert categories" required="required"
      autocomplete="off">
  </div>
  <!-- submit button -->
  <div class="input-group w-10 m-3">
    <input type="submit" class="btn btn-info" value="Insert Categories">
  </div>
</form>
<!-- code for insert into database -->
<?php
// database connection
include './../database.php';
if (!empty($_POST["cat_title"])) 
{
  if(isset($_SESSION['login']))
{
  $cat_name = $_POST["cat_title"];
  $result_select = "SELECT * FROM categories WHERE cat_title='$cat_name'";
  $number = mysqli_query($con, $result_select);
  // to check already exists or not
  $result = mysqli_num_rows($number);
  if ($result > 0) {
    echo "<script>alert('$cat_name is alredy inserted into categories')</script>";
  } else {
    $qry = "INSERT INTO categories(cat_title)VALUE('$cat_name')";
    $result = mysqli_query($con, $qry);
    if ($result) {
      echo "<script>alert('Successfully $cat_name is inserted into categories')</script>";
    }
  }
}else
{
    echo "<script>window.location.href='admin.php?login';</script>";
}
}
}
?>