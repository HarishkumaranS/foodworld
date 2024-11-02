<?php
// database connection
include './../database.php';
function editdel_payment()
{
    global $con;
    ?>
    <h4 align="center"><b>Edit Category</b></h4>
<?php
if (isset($_GET['pay_Eid']) || isset($_GET['pay_Did'])) {
    if(isset($_SESSION['login']))
    {
    if (isset($_GET['pay_Did'])) {
        $d_id = $_GET['pay_Did'];
        // del qry
        $del_qry = "DELETE FROM payment WHERE payment_id=$d_id";
        $result_del = mysqli_query($con, $del_qry);
        // php href link
        echo "<script>window.location.href='admin.php?view_payment';</script>";
        // header('Location:admin.php?view_payment');
    }
    if (isset($_GET['pay_Eid'])) {
        $e_id = $_GET['pay_Eid'];
        // select qry
        $select_qry = "SELECT * FROM payment WHERE payment_id='$e_id'";
        $result_select = mysqli_query($con, $select_qry);
        $row = mysqli_fetch_array($result_select);
        $pay_type = $row['payment_type'];
        ?>
        <!-- form for update input -->
        <form action="" method="post" class="mb-2">
            <!-- input for  Categories title -->
            <div class="input-group w-90 m-3">
                <!-- icons -->
                <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
                <input type="text" class="form-control" name="update_payment" placeholder="Update Payment Type" required="required"
                    value="<?php echo $pay_type; ?>">
            </div>
            <!-- submit button -->
            <div class="input-group w-10 m-3">
                <input type="submit" class="btn btn-info" value="Update Payment">
            </div>
        </form>
       <?php
       // update qry
       if(isset($_POST['update_payment']))
       {
       $update_type=$_POST['update_payment'];
       $update_qry="UPDATE payment SET payment_type='$update_type' WHERE payment_id='$e_id'";
       $result_update=mysqli_query($con,$update_qry);
    //    alert box for sucessfully updated
       if($result_update)
       {
        // alert box
        echo "<script>alert('Sucessfully Updated')</script>";
        // js href link
        echo "<script>window.location.href='admin.php?view_payment';</script>";
       }
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