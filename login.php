<style>
    .form-container {
        border: 1px solid #ccc;
        /* Border around the form */
        border-radius: 8px;
        /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Box shadow */
        padding: 20px;
        /* Padding inside the form */
        background-color: white;
        /* Background color of the form */
    }

    .form-control {
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        border-color: #66afe9;
        box-shadow: 0 0 8px rgba(102, 175, 233, 0.6);
    }

    .invalid-feedback {
        display: none;
        /* Hide invalid feedback by default */
    }

    input:invalid+.invalid-feedback,
    textarea:invalid+.invalid-feedback {
        display: block;
        /* Show feedback if the input is invalid */
    }

    .login-form {
        margin-left: 20rem;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 100%;
        max-width: 400px;
    }
</style>
<?php
// database connection
include 'database.php';
session_start();
// login php code
if (isset($_GET['login'])) {
    if (isset($_POST['phone'])) {
        $num = $_POST['phone'];
        $pass = $_POST['password'];
        $select_qry = "SELECT user_name,user_id FROM user WHERE mob_num1='$num' and user_pass='$pass'";
        $result_select = mysqli_query($con, $select_qry);
        $num = mysqli_num_rows($result_select);
        if ($num == 1) {
            $row = mysqli_fetch_array($result_select);
            $user_name = $row['user_name'];
            $user_id = $row['user_id'];
            if (isset($user_name) && isset($user_id)) {
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_id'] = $user_id;
                if (isset($_SESSION['user_name']) && isset($_SESSION['user_id'])) {
                    // header('Location:Food World.php');
                    echo "<script>window.location.href='index.php';</script>";
                }
            }
        } else {
            $incorrect_pass = "User Name and Password incorrect";
        }
    }
}
// logout php code
if (isset($_GET['logout'])) {
    unset($_SESSION['user_name']);
    unset( $_SESSION['cart']);
    session_destroy();
    header('Location:login_logout.php?login');
}
// create php code
if (isset($_GET['create_account'])) {
    if (isset($_POST['username'])) {

        $number_1 = $_POST['phone1'];
        $user_qry = "SELECT 1 FROM user WHERE mob_num1 = $number_1 LIMIT 1";
        $result_select = mysqli_query($con, $user_qry);
        $num = mysqli_num_rows($result_select);
        if ($_POST['password'] != $_POST['confirm_password']) {
            $invlide_confirm_password = "Please enter the same Password";
        } elseif ($num >= 1) {
            $invlide_phone1 = "The Phone is already exists";
        } else {
            //     echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            $user_name = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $num1 = $_POST['phone1'];
            $num2 = $_POST['phone2'];
            $add = $_POST['address'];
            $insert_qry = "INSERT INTO user(user_name,user_email,user_pass,mob_num1,mob_num2,address)VALUES('$user_name','$email','$password',$num1,$num2,'$add')";
            $reslut_qry = mysqli_query($con, $insert_qry);
            if ($reslut_qry) {

                echo "<script>alert('Succesfully Registered');
            window.location.href='login_logout.php?login';</script>";
            }
        }

    }
}
if (isset($_GET['forgot_pass'])) {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    if (isset($_POST['email'])) {
        //    echo $user_name=$_POST['username'];
        // echo $_SESSION['captcha_code']."<br>";
        // echo $_POST['captchaInput']."<br>";
        if ($_SESSION['captcha_code'] != $_POST['captchaInput']) {
            $invalid_captcha = "Please enter the currect captcha";
        } else {
            $email = $_POST['email'];
            $num1 = $_POST['phone1'];
            $num2 = $_POST['phone2'];
            $select_qry = "SELECT user_id from user where user_email='$email' and mob_num1=$num1 and mob_num2=$num2";
            $result_qry = mysqli_query($con, $select_qry);
            $row = mysqli_fetch_array(result: $result_qry);
            $num = mysqli_num_rows(result: $result_qry);
            $user_id=isset($row['user_id']);
            if ($num == 1 && isset($row['user_id'])) {
                // echo "n";
                echo "<script>window.location.href='login_logout.php?new_password=$user_id';</script>";
            } else {
                $invalid = "No match found ";
            }

         }
    }
}
if (isset($_GET['new_password'])) {
    $user_id = $_GET['new_password'];
    if (isset($_POST['newpassword'])) {
        //     echo "<pre>";
        //     echo $_GET['new_password'];
        //    print_r($_POST);
        //    echo "</pre>";

        if ($_POST['newpassword'] != $_POST['confirm_password']) {
            $invlide_confirm_password = "Please enter the same Password";
        } else {
            $pass = $_POST['newpassword'];
            $update_qry = "UPDATE user SET user_pass='$pass' where user_id=$user_id";
            $result_qry = mysqli_query($con, $update_qry);
            if ($result_qry) {
                echo "<script>alert('Succesfully Password Updated');
            window.location.href='login_logout.php?login';</script>";
            }
        }


    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- logo in title bar -->
    <link rel="icon" href="https://i.ibb.co/qp8R5mk/1000005311-removebg-preview.png" type="image/x-icon">
    <!-- css link -->
    <link rel="stylesheet" href="food.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- font-awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-image: url("https://i.ibb.co/pwWCMfD/seamless-pattern-outline-icons-on-600nw-566053102.webp");
        background-size: auto;
        background-attachment: fixed;
    }

    .login-container {
        background-color: skyblue;
        margin-top: 7rem;
        border: 7px solid white;
        border-radius: 7px;
    }
</style>

<body>
    <header class="sticky-top">
        <!-- nav bar -->
        <nav class="navbar navbar-light " style="background-color: #03a9f4;">
            <!-- Image and text -->
            <a class="navbar-brand" href="#">
                <!-- back button -->
                <i class="fas fa-arrow-left text-light" id="back"></i>
                <img class="logo" src="https://i.ibb.co/qp8R5mk/1000005311-removebg-preview.png">
                <!-- title -->
                <b class="title">Food World</b>
            </a>
        </nav>
    </header>
    <div class="container p-5">
        <!-- login  -->
        <?php if (isset($_GET['login'])) { ?>
            <div class="login-form">
                <h2 class="text-center">Login</h2>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" name="phone" placeholder="Enter your phone number"
                            value="<?php if (isset($_POST['phone'])) {
                                echo $_POST['phone'];
                            } ?>">
                    </div>

                    <div class="form-group m-0 p-0">
                        <label for="password">Password</label>
                        <input type="password" class="form-control <?php
                        if (isset($incorrect_pass) && isset($_GET['login'])) {
                            echo 'is-invalid text-danger';
                        } ?>"
                            name="password" required
                            value="<?php if (isset($_POST['password'])) {
                                echo $_POST['password'];
                            } ?>" placeholder="Enter your Password">
                    </div>
                    <div class="form-group ">
                        <a href="login_logout.php?forgot_pass" class="forgot-password">Forgot Password?</a>
                    </div>
                    <?php
                    if (isset($incorrect_pass) && isset($_GET['login'])) {
                        echo "<div class='form-group text-danger'>$incorrect_pass</div>";
                    }
                    ?>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                    <div class="form-group m-0 p-0">
                        <a href="login_logout.php?create_account" class="create-account">Create an Account</a>
                    </div>
                </form>
            </div>


        <?php } ?>
        <!--  create account -->
        <?php if (isset($_GET['create_account'])) { ?>
            <div class="form-container">
                <h2 class="text-center">User Registration</h2>
                <form class="mt-4" action="" method="post">
                    <div class="form-group">
                        <label for="username">User Name</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter your name" required
                            value="<?php if (isset($_POST['username'])) {
                                echo $_POST['username'];
                            } ?>">
                        <?php if (isset($_POST['submit'])) { echo'<div class="invalid-feedback">Please enter your name.</div>';}?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required
                            value="<?php if (isset($_POST['email'])) {
                                echo $_POST['email'];
                            } ?>">
                        <?php if (isset($_POST['submit'])) { echo'<div class="invalid-feedback">Please enter a valid email address.</div>';}?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password"
                            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$" required
                            minlength="6" value="<?php if (isset($_POST['password'])) {
                                echo $_POST['password'];
                            } ?>">
                        <div class="invalid-feedback">Password must be at least 6 characters long, contain at least one
                            uppercase letter, one lowercase letter, one number, and one special character.</div>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password"
                            class="form-control <?php if (isset($invlide_confirm_password)) {
                                echo "is-invalid text-danger";
                            } ?>"
                            name="confirm_password"
                            
                            placeholder="Confirm your password" required
                            value="<?php if (isset($_POST['confirm_password'])) {
                                echo $_POST['confirm_password'];
                            } ?>">

                        <?php if (isset($invlide_confirm_password)) {
                            echo "<div class='text-danger'>$invlide_confirm_password</div>";
                        }  
                        // if (isset($_POST['submit'])) { echo'<div class="invalid-feedback">Please confirm your password.</div>';
                        // } ?>
                    </div>
                    <div class="form-group">
                        <label for="phone1">Phone Number 1</label>
                        <input type="tel"
                            class="form-control <?php if (isset($invlide_phone1)) {
                                echo "is-invalid text-danger";
                            } ?>"
                            name="phone1" placeholder="Enter your phone number" required pattern="[0-9]{10}"
                            value="<?php if (isset($_POST['phone1'])) {
                                echo $_POST['phone1'];
                            } ?>">
                        <?php if (isset($invlide_phone1)) {
                            echo "<div class='text-danger'>$invlide_phone1</div>";
                        } 
                        //  if (isset($_POST['submit'])) { echo'<div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>';
                        // } ?>
                    </div>
                    <div class="form-group">
                        <label for="phone2">Phone Number 2</label>
                        <input type="tel" class="form-control" name="phone2" placeholder="Enter your second phone number"
                            required pattern="[0-9]{10}"
                            value="<?php if (isset($_POST['phone2'])) {
                                echo $_POST['phone2'];
                            } ?>">
                        <?php if (isset($_POST['submit'])) { echo'<div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>';}?>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="address" rows="3" placeholder="Enter your address"
                            required><?php if (isset($_POST['address'])) {
                                echo $_POST['address'];
                            } ?></textarea>
                       <?php if (isset($_POST['submit'])) { echo'<div class="invalid-feedback">Please enter your address.</div>';}?>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        <?php } ?>
        <!-- forgot password  -->
        <?php if (isset($_GET['forgot_pass'])) { ?>
            <div class="container mt-5">
                <!-- Responsive form with border, shadow, and validation using Bootstrap classes -->
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="border p-4 shadow rounded bg-white" style="border-radius: 15px;">
                            <h2 class="text-center mb-4">User Form</h2>
                            <form id="userForm" action="" method="POST">
                                <!-- <div class="form-group">
                        <label for="userName">User Name</label>
                        <input type="text" class="form-control" id="userName" name="username" placeholder="Enter your name" required>
                        <div class="invalid-feedback">Please enter your name.</div>
                    </div> -->

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email"
                                        class="form-control"
                                        id="email" name="email" placeholder="Enter your email" required
                                        value="<?php if (isset($_POST['email'])) {
                                            echo $_POST['email'];
                                        } ?>">
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>

                                <div class="form-group">
                                    <label for="phone1">Phone 1</label>
                                    <input type="tel"
                                        class="form-control"
                                        id="phone1" name="phone1" placeholder="Enter primary phone number"
                                        pattern="[0-9]{10}" required
                                        value="<?php if (isset($_POST['phone1'])) {
                                            echo $_POST['phone1'];
                                        } ?>">
                                    <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                                </div>

                                <div class="form-group">
                                    <label for="phone1">Phone 2</label>
                                    <input type="tel"
                                        class="form-control"
                                        id="phone1" name="phone2" placeholder="Enter Secondary phone number"
                                        pattern="[0-9]{10}" required
                                        value="<?php if (isset($_POST['phone2'])) {
                                            echo $_POST['phone2'];
                                        } ?>">
                                    <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                                </div>
                                <?php
                                if (isset($invalid)) {
                                    echo "<div class='form-group text-danger'>$invalid</div>";
                                }
                                ?>
                                <div class="form-group">
                                    <!-- <label for="captcha">CAPTCHA</label> -->
                                    <div class="captcha-container d-flex align-items-center">
                                        <!-- Display CAPTCHA Image -->
                                        <img src="captcha/captcha.php" alt="CAPTCHA Image" id="captchaImage">
                                        <!-- Refresh CAPTCHA Icon with two-tone color -->
                                        <i class="fas fa-sync-alt ml-2 two-tone-icon"
                                            onclick="document.getElementById('captchaImage').src='captcha/captcha.php?' + Math.random();"></i>
                                    </div>
                                    <input type="text"
                                        class="form-control mt-2 <?php if (isset($invalid_captcha)) {
                                            echo 'is-invalid text-danger';
                                        } ?>"
                                        id="captchaInput" name="captchaInput" placeholder="Enter CAPTCHA" required>
                                    <?php if (isset($invalid_captcha)) {
                                        echo "<div class='invalid-feedback'>$invalid_captcha</div>";
                                    } ?>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (isset($_GET['new_password'])) {
            $user_id = $_GET['new_password'];
            $select_qry = "SELECT user_name from user where user_id=$user_id";
            $result_qry = mysqli_query($con, $select_qry);
            $row = mysqli_fetch_array(result: $result_qry);
            $user_name = $row['user_name'];
            ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-container">
                            <form action="" method="post">
                                <h2 class="text-center mb-4"><?php echo $user_name; ?> Account</h2>

                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" name="newpassword"
                                        placeholder="Enter your password"
                                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$"
                                        required minlength="6"
                                        value="<?php if (isset($_POST['newpassword'])) {
                                            echo $_POST['newpassword'];
                                        } ?>">
                                    <div class="invalid-feedback">Password must be at least 6 characters long, contain at
                                        least one uppercase letter, one lowercase letter, one number, and one special
                                        character.</div>
                                </div>

                                <div class="form-group">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input type="password"
                                        class="form-control <?php if (isset($invlide_confirm_password)) {
                                            echo "is-invalid text-danger";
                                        } ?>"
                                        name="confirm_password"
                                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$"
                                        placeholder="Confirm your password" required minlength="6"
                                        value="<?php if (isset($_POST['confirm_password'])) {
                                            echo $_POST['confirm_password'];
                                        } ?>">

                                    <?php if (isset($invlide_confirm_password)) {
                                        echo "<div class='text-danger'>$invlide_confirm_password</div>";
                                    } else {
                                        echo '<div class="invalid-feedback">Please confirm your password.</div>';
                                    } ?>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <script>
            let back = document.getElementById('back');
            back.addEventListener('click', function () {
                window.history.back();
            });
        </script>
</body>

</html>