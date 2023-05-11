<?php
include "../includes/header.php";
include "../includes/db.php";
session_start();

$sql = "SELECT * FROM batch";
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
?>

<div class="container">
    <form class="form-1" method="post">
        <h2>Students Signup</h2>
        <label for="email">Full Name</label>
        <input type="text" name="fullName" id="email" required />

        <label for="email">Username</label>
        <input type="text" name="userName" id="email" required />

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required />

        <label for="email">Total credits completed</label>
        <input type="number" name="credits" id="email" required />

        <label for="email">Batch</label>
        <select name="batch" id="selectField">
            <option disabled selected>Choose</option>
            <?php while ($data = $result->fetch_assoc()) { ?>
                <option value="<?= $data['name'] ?>">
                    <?= $data['name'] ?>
                </option>
            <?php } ?>
        </select>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required />
        <input type="submit" value="Login" name="stucreate" class="login-btn1">
    </form>
</div>

<?php

if (isset($_POST['stucreate'])) {

    $email = $_POST['email'];
    $pass = $_POST['password'];
    $username = $_POST['userName'];
    $fullname = strtoupper($_POST['fullName']);
    $batch = $_POST['batch'];
    $credits = $_POST['credits'];

    $checkusernamesql = "SELECT username FROM students";
    $checkusernameresult = mysqli_query($mysqli, $checkusernamesql) or die(mysqli_error($mysqli));
    $count = mysqli_num_rows($checkusernameresult);

    if ($count > 0) {

        echo "<script>
        alert('Username already exists');
        window.location='/course/students/students_signup.php';
        </script>";

    } else {

        $newstusql = "INSERT INTO 
        students(full_name, username, batch, email, password, credits)
        VALUES('$fullname', '$username', '$batch', '$email', '$pass', '$credits')";

        if ($mysqli->query($newstusql)) {

            echo "<script>
            alert('Succesful!');
            window.location='/course/students/students_login.php';
            </script>";

        } else {

            echo "<script>
            alert('Something Went Wrong');
            window.location='/course/students/students_signup.php';
            </script>";

        }
    }

}

?>

<?php
include "../includes/footer.php";
?>