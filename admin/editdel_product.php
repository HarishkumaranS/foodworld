<?php
// database connection
include './../database.php';
function editdel_product()
{
?>
<h4 align="center"><b>Edit Product</b></h4>
<?php
// database connection
include './../database.php';
// $e_id=$_GET['PEid'];
if (isset($_GET['PEid']) || isset($_GET['PDid'])) {
    if(isset($_SESSION['login']))
{
    if (isset($_GET['PDid'])) {
        $d_id = $_GET['PDid'];
        // del qry
        $del_qry = "DELETE FROM product WHERE product_id='$d_id'";
        $result_del = mysqli_query($con, $del_qry);
        // php href link
        // header('Location:admin.php?view_product');
        echo "<script>window.location.href='admin.php?view_product';</script>";
    }
    if (isset($_GET['PEid'])) {
        $e_id = $_GET['PEid'];
        $select_qry = "SELECT * FROM product WHERE product_id='$e_id'";
        $result_select = mysqli_query($con, $select_qry);
        $row = mysqli_fetch_array($result_select);
        $product_name = $row['product_name'];
        $product_des = $row['product_des'];
        $product_scale = $row['product_scale'];
        $product_keyword = $row['product_keyword'];
        $product_cat = $row['product_cat'];
        $product_stock = $row['product_stock'];
        $product_price = $row['product_price'];
        $product_off = $row['product_off'];
        ?>
        <form action="" method="post" class="mb-2" enctype="multipart/form-data">
            <!-- product name -->
            <div class="form-outline m-3">
                <label for="product name" class="form-label">Product Name</label>
                <input type="text" class="form-control w-50" name="product_name" placeholder="Enter Product Name"
                    autocomplete="off" required="required" value="<?php echo $product_name; ?>">
            </div>
            <!-- product Scale -->
            <div class="form-outline m-3">
                <label for="product Keyword" class="form-label">Product Scale</label>
                <input type="text" class="form-control w-50" name="product_scale" placeholder="Enter Product Description"
                    autocomplete="off" required="required" value="<?php echo $product_scale; ?>">
            </div>
            <!-- product description -->
            <div class="form-outline m-3">
                <label for="product Keyword" class="form-label">Product Description</label>
                <input type="text" class="form-control w-50" name="product_des" placeholder="Enter Product Description"
                    autocomplete="off" required="required" value="<?php echo $product_des; ?>">
            </div>
            <!-- product keyword -->
            <div class="form-outline m-3">
                <label for="product Keyword" class="form-label">Product Keyword</label>
                <input type="text" class="form-control w-50" name="product_keyword" placeholder="Enter Product Keyword"
                    autocomplete="off" required="required" value="<?php echo $product_keyword; ?>">
            </div>
            <!-- product categories -->
            <div class="form-outline  m-3">
                <label for="product Categories" class="form-label">Product Categories</label>
                <select name="product_cat" class="form-select w-50" required aria-selected="<?php echo $product_cat; ?>">
                    <option value="">-Select Categories-</option>
                    <?php
                    $select_cat = "SELECT * FROM categories";
                    $result = mysqli_query($con, $select_cat);
                    while ($row = mysqli_fetch_array($result)) {
                        $cat = $row['cat_title'];
                        echo "<option value='$cat'>$cat</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- product Stock-->
            <div class="form-outline m-3">
                <label for="product stock" class="form-label">Product Stock</label>
                <input type="number" class="form-control w-50" name="product_stock" placeholder="Enter Product Stock"
                    autocomplete="off" required="required" value="<?php echo $product_stock; ?>">
            </div>
            <!-- product price -->
            <div class="form-outline m-3">
                <label for="product Keyword" class="form-label">Product Price</label>
                <input type="number" class="form-control w-50" name="product_Price" placeholder="Enter Product Price"
                    autocomplete="off" required="required" value="<?php echo $product_price; ?>">
            </div>
            <!-- product off-->
            <div class="form-outline m-3">
                <label for="product Off" class="form-label">Product Off</label>
                <input type="number" class="form-control w-50" name="product_off" placeholder="Enter Product Off"
                    autocomplete="off" required="required" value="<?php echo $product_off; ?>">
            </div>
            <!-- submit button -->
            <div class="form-outline w-10 m-3">
                <input type="submit" name="submit" class="btn btn-info" value="Update Product">
            </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
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
            // code for update data in database
            $update_qry = "UPDATE product SET product_name='$product_name',product_scale='$product_scale',product_des='$product_des',product_keyword='$product_keyword',product_cat='$product_cat',product_stock='$product_stock',product_price='$product_price',product_off='$product_off',product_c_price='$product_c_price'WHERE product_id='$e_id'";
            $result = mysqli_query($con, $update_qry);
            if ($result) {
                // alert box
                echo "<script>alert('Sucessfully Updated')</script>";
                // js href link
                echo "<script>window.location.href='admin.php?view_product';</script>";
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