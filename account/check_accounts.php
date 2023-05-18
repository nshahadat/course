<?php
include "../includes/header.php";
include "../includes/db.php";
session_start();
?>

<?php

$datasql = "SELECT p.*,s.* 
FROM payment p
JOIN students s ON p.student_name = s.username";
$dataresult = mysqli_query($mysqli, $datasql) or die(mysqli_error($mysqli));

?>

<div class="container">
    <div class="btn-section">
        <div class="username-btn">
            <button style="min-width:150px !important">
                <?= $_SESSION['username'] ?>
            </button>
        </div>
        <a href="../index.php">
            <div class="logout-btn"><button>logout</button></div>
        </a>
        <a href="/course/account/account_feed.php">
            <div class="adv-btn">
                <button style="right:35vw !important">Go Back</button>
            </div>
        </a>
    </div>
    <hr>

    <?php if (mysqli_num_rows($dataresult) > 0) { ?>

        <table class="table" id="myTable" data-filter-control="true" data-show-search-clear-button="true">
            <tr>
                <th>Student Name</th>
                <th>Student Batch</th>
                <th>Which course to Enroll</th>
                <th>Payment for that course</th>
            </tr>
            <?php while ($data = mysqli_fetch_assoc($dataresult)) {

                if ($data['payment_complete'] == 1) {

                    $complete = "Yes";

                } else if ($data['payment_complete'] == 0) {

                    $complete = "No";

                }

                ?>
                <tr>
                    <td>
                        <?= $data['student_name'] ?>
                    </td>
                    <td>
                        <?= $data['batch'] ?>
                    </td>
                    <td>
                        <?= $data['payment_course'] ?>
                    </td>
                    <td>
                        <?= $complete ?>
                    </td>
                </tr>
            <?php }
    } else { ?>
            <h1>No new applies right now</h1>
        <?php } ?>
    </table>
</div>

<?php

if (isset($_POST['savebtn'])) {

    $data = $_POST['practical'];
    $stuhidden = $_POST['stuidhidden'];
    $courhidden = $_POST['couridhidden'];

    $updatedatasql = "UPDATE pending_course_requests 
    SET con_from_acc = $data 
    WHERE student_name = '$stuhidden' AND course_title = '$courhidden'";
    mysqli_query($mysqli, $updatedatasql) or die(mysqli_error($mysqli));

    echo "<script>
    alert('You just changed the payment information of this student');
    window.location = '/course/account/check_applies.php';
    </script>";

}

?>

<?php
include "../includes/footer.php";
?>