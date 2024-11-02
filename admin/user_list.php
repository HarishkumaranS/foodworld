<?php
function user_list()
{
    if(isset($_SESSION['login']))
{
?>
<style>
    /* td,
    th {
        background-color: pink;
        border: 2px outset black;
        padding: 3px;
        text-align: center;
        color: black;
    } */

    a {
        text-decoration: none;
        color: black;
    }
</style>
<!-- heading -->
<h4 align="center"><b>User List</b></h4>
<?php
// database connection
// database connection
include './../database.php';
// view user
if (isset($_GET['user_list'])) {
    $select_cat = "SELECT * FROM user";
    $result_cat = mysqli_query($con, $select_cat);
     echo "<table align='center' class='table table-striped table-light'><thead class='thead-dark'><tr><th scope='col'>S.No</th><th scope='col'>User Name</th><th scope='col'>Email</th><th scope='col'>Number 1</th><th scope='col'>Number 2<th scope='col'>Address</th><th scope='col'>Password</th><th scope='col'>Delete</th></tr>";
    //echo "<table align='center' class='table table-striped table-light'><thead class='thead-dark'><tr><th scope='col'>S.No</th><th scope='col'>Categoty</th><th scope='col'>Edit</th><th scope='col'>Delete</th></tr></thead><tbody>";
    while ($row = mysqli_fetch_array($result_cat)) {
        $user_id = $row['user_id'];
        $pay_type = $row['user_name'];
        $user_mail = $row['user_email'];
        $user_pass = $row['user_pass'];
        $user_num1 = $row['mob_num1'];
        $user_num2 = $row['mob_num2'];
        $user_add = $row['address'];
        echo "<tr><td scope='row'>$user_id</td><td>$pay_type</td></td><td>$user_mail</td><td>$user_num1</td><td>$user_num2</td><td>$user_add</td><td>$user_pass</td><td><a onclick='del_user()'><i class='fa-solid fa-trash del_color'></i></a></tr>";
    }
    echo "</table>";
}
// User
if (isset($_GET['user_Did'])) {
    $pay_id = $_GET['user_Did'];
    $del_qry = "DELETE FROM user WHERE user_id=$user_id";
    $result_del = mysqli_query($con, $del_qry);
    if ($result_del) {
        // header('Location:admin.php');
        echo "<script> window.location.href='admin.php?user_list;</script>";
    }
}
}
else
{
    echo "<script>window.location.href='admin.php?login';</script>";
}
}
?>
<script>
    function del_user() {
        var title_value = confirm('Do you want to Delete');
        if (title_value == true) {
            // js href link
            window.location.href = 'admin.php?user_Did=<?php echo $user_id ?>';
        }
    }
</script>