<?php
include "../includes/header.php";
include "../includes/db.php";
?>

<div class="container">
    <form class="form-1" method="post">
        <h2>Admin Login</h2>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required />
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required />
        <!-- <span>Forgot Password</span> -->
        <input type="submit" name="loginbtn" value="Login" class="login-btn1">
    </form>
</div>

<?php

if (isset($_POST['loginbtn'])) {
    $u_signin_email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $u_signin_pass = mysqli_real_escape_string($mysqli, $_POST['password']);

    $sql = "SELECT * FROM admin WHERE email = '$u_signin_email' AND password = '$u_signin_pass'";

    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    $numrows = mysqli_num_rows($result);
    $data = mysqli_fetch_assoc($result);

    if ($numrows == 0) {
        echo "<script>alert('Wrong email or password');</script>";
    } else {
        session_start();
        $_SESSION['email'] = $u_signin_email;
        $_SESSION['username'] = $data['name'];
        echo "<script>window.location='/course/admin/admin_feed.php'</script>";
    }
}

?>

<?php
include "../includes/footer.php";
?>