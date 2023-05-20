<?php
include "../includes/header.php";
include "../includes/db.php";
session_start();

$sql = "SELECT * FROM batch";
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
?>

<div class="container">

    <div class="btn-section">
        <a href="./admin_feed.php">
            <div class="logout-btn">
                <button>Go Back</button>
            </div>
        </a>
    </div>

    <form class="form-1" method="post">
        <h2>Add Advisor</h2>

        <label for="email">Full Name</label>
        <input type="text" name="fullName" id="email" required />

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required />

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

        <input type="submit" value="Sign Up" name="advcreate" class="login-btn1">
    </form>
</div>

<?php

if (isset($_POST['advcreate'])) {

    $email = $_POST['email'];
    $pass = $_POST['password'];
    $fullname = strtoupper($_POST['fullName']);
    $batch = $_POST['batch'];

    $checkusernamesql = "SELECT name FROM advisor WHERE name = '$fullname'";
    $checkusernameresult = mysqli_query($mysqli, $checkusernamesql) or die(mysqli_error($mysqli));
    $count = mysqli_num_rows($checkusernameresult);

    if ($count > 0) {

        echo "<script>
        alert('User already exists');
        window.location='./add_advisor.php';
        </script>";

    } else {

        $newstusql = "INSERT INTO 
        advisor(name, batch, email, password)
        VALUES('$fullname', '$batch', '$email', '$pass')";

        if ($mysqli->query($newstusql)) {

            echo "<script>
            alert('Succesful!');
            window.location='./add_advisor.php';
            </script>";

        } else {

            echo "<script>
            alert('Something Went Wrong');
            window.location='./add_advisor.php';
            </script>";

        }
    }

}

?>

<?php
include "../includes/footer.php";
?>