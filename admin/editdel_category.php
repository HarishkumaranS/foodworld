<?php
// database connection
include './../database.php';
function editdel_category()
{
    global $con;
?>
<h4 align="center"><b>Edit Category</b></h4>
<?php
if (isset($_GET['CEid']) || isset($_GET['CDid'])) {
    if(isset($_SESSION['login']))
{
    if (isset($_GET['CDid'])) {
        $d_id = $_GET['CDid'];
        // del qry
        $del_qry = "DELETE FROM categories WHERE cat_id='$d_id'";
        $result_del = mysqli_query($con, $del_qry);
        // php href link
        echo "<script>window.location.href='admin.php?view_cat';</script>";
    }
    if (isset($_GET['CEid'])) {
        $e_id = $_GET['CEid'];
        // select qry
        $select_qry = "SELECT * FROM categories WHERE cat_id='$e_id'";
        $result_select = mysqli_query($con, $select_qry);
        $row = mysqli_fetch_array($result_select);
        $pay_type = $row['cat_title'];
        ?>
        <!-- form for update input -->
        <form action="" method="post" class="mb-2">
            <!-- input for  Categories title -->
            <div class="input-group w-90 m-3">
                <!-- icons -->
                <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
                <input type="text" class="form-control" name="update_title" placeholder="Update categories" required="required"
                    value="<?php echo $pay_type; ?>">
            </div>
            <!-- submit button -->
            <div class="input-group w-10 m-3">
                <input type="submit" class="btn btn-info" value="Update Categories">
            </div>
        </form>
       <?php
       // update qry
       if(isset($_POST['update_title']))
       {
       $update_title=$_POST['update_title'];
       $update_qry="UPDATE categories SET cat_title='$update_title' WHERE cat_id='$e_id'";
       $result_update=mysqli_query($con,$update_qry);
    //    alert box for sucessfully updated
       if($result_update)
       {
        // alert box
        echo "<script>alert('Sucessfully Updated')</script>";
        // js href link
        echo "<script>window.location.href='admin.php?view_cat';</script>";
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