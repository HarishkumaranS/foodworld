<?php
function insert_payment()
{
?>
<!-- heading -->
<h4 align="center"><b>Insert Payment Type</b></h4>
<form action="" method="post" class="mb-2">
  <!-- input for  Categories title -->
  <div class="input-group w-90 m-3">
    <!-- icons -->
    <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-money-bill text-info"></i></span>
    <!-- text field -->
    <input type="text" class="form-control" name="pay_type" placeholder="Insert Payment Type" required="required"
      autocomplete="off">
  </div>
  <!-- submit button -->
  <div class="input-group w-10 m-3">
    <input type="submit" class="btn btn-info" value="Insert Payment">
  </div>
</form>
<!-- code for insert into database -->
<?php
// database connection
include './../database.php';
if (!empty($_POST["pay_type"])) 
{
  if(isset($_SESSION['login']))
{
  $pay_type = $_POST["pay_type"];
  $result_select = "SELECT * FROM payment WHERE payment_type='$pay_type'";
  $number = mysqli_query($con, $result_select);
  // to check already exists or not
  $result = mysqli_num_rows($number);
  if ($result > 0) {
    echo "<script>alert('$pay_type is alredy inserted into categories')</script>";
  } else {
    $qry = "INSERT INTO payment(payment_type)VALUE('$pay_type')";
    $result = mysqli_query($con, $qry);
    if ($result) {
      echo "<script>alert('Successfully $pay_type is inserted into Payment table')</script>";
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