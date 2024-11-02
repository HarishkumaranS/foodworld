<?php
function login()
{
    if(isset($_GET['login']))
    {
        if(isset($_POST['username']) && isset($_POST['password']))
{
    $invalid=null;
    $user_name=$_POST['username'];
    $password=$_POST['password'];
    // print_r( $_POST);
    if($user_name=="Harishkumaran" && $password=="Harishkumaran@29")
    {
        $_SESSION['login']=1;
        if(isset($_SESSION['login']))
        {
             echo "<script>window.location.href='admin.php';</script>";
            // echo "dd";
        }
    }
    else
    {
     $invalid="User Name and Password are invalide";
    }
}
        ?>
<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="bg-white p-4 rounded shadow col-12 col-md-4">
        <h2 class="text-center">Login</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Enter your username" required value="<?php if(isset($_POST['username'])){echo $_POST['username']; }?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control <?php if (isset($invalid)) { echo 'is-invalid text-danger'; } ?>" name="password" placeholder="Enter your password" required>
            </div>
            <?php if (isset($invalid)): ?>
                <div class='form-group text-danger mb-3'><?php echo $invalid; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>
</div>
<?php
    }
    elseif(isset($_GET['logout']))
    {
        unset( $_SESSION['login']);
        session_destroy();
        echo "<script>window.location.href='admin.php';</script>";
    }
}

?>