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

        <label for="email">Student ID</label>
        <input type="number" name="stuid" id="email" required />

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
        <input type="submit" value="Sign Up" name="stucreate" class="login-btn1">
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
    $stuid = $_POST['stuid'];

    $checkusernamesql = "SELECT username FROM students WHERE username = '$username'";
    $checkusernameresult = mysqli_query($mysqli, $checkusernamesql) or die(mysqli_error($mysqli));
    $count = mysqli_num_rows($checkusernameresult);

    if ($count > 0) {

        echo "<script>
        alert('Username already exists');
        window.location='./students_signup.php';
        </script>";

    } else {

        $newstusql = "INSERT INTO 
        students(full_name, username, batch, student_id, email, password, credits)
        VALUES('$fullname', '$username', '$batch', '$stuid', '$email', '$pass', '$credits')";

        if ($mysqli->query($newstusql)) {

            echo "<script>
            alert('Succesful!');
            window.location='./students_login.php';
            </script>";

        } else {

            echo "<script>
            alert('Something Went Wrong');
            window.location='./students_signup.php';
            </script>";

        }
    }

}

?>

<?php
include "../includes/footer.php";
?>