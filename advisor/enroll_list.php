<?php
include "../includes/header.php";
include "../includes/db.php";
session_start();
?>

<?php
$advisor = $_SESSION['username'];

$datasql = "SELECT c.*,o.*,s.*
FROM confirmed_courses c
JOIN offered_courses o ON c.course_title = o.title
JOIN students s ON c.student_name = s.username
WHERE o.course_teacher = '$advisor'";
$dataresult = mysqli_query($mysqli, $datasql) or die(mysqli_error($mysqli));
?>

<div class="container">
    <div class="btn-section">
        <div class="username-btn"><button>
                <?= $_SESSION['username'] ?>
            </button></div>
        <a href="../logout.php">
            <div class="logout-btn"><button>logout</button></div>
        </a>
        <a href="./advisor_feed.php">
            <div class="adv-btn">
                <button>Go Back</button>
            </div>
        </a>
    </div>
    <hr>
    <?php

    if (mysqli_num_rows($dataresult) > 0) {

        ?>
        <table class="table" id="myTable" data-filter-control="true" data-show-search-clear-button="true">
            <tr>
                <th>Student Name</th>
                <th>Student Id</th>
                <th>Student Batch</th>
                <th>Enrolled Course</th>
            </tr>
            <?php while ($data = mysqli_fetch_assoc($dataresult)) {

                ?>
                <tr>
                    <td>
                        <?= $data['full_name'] ?>
                    </td>
                    <td>
                        <?= $data['student_id'] ?>
                    </td>
                    <td>
                        <?= $data['batch'] ?>
                    </td>
                    <td>
                        <?= $data['title'] ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else {
        echo "<div>No pending requests right now.</div>";
    } ?>
</div>

<?php

if (isset($_POST['savebtn'])) {

    $data = $_POST['practical'];
    $stuhidden = $_POST['stuidhidden'];
    $courhidden = $_POST['couridhidden'];

    $updatedatasql = "UPDATE pending_course_requests 
    SET con_from_adv = $data 
    WHERE student_name = '$stuhidden' AND course_title = '$courhidden'";
    mysqli_query($mysqli, $updatedatasql) or die(mysqli_error($mysqli));

    echo "<script>
    alert('You just changed the payment information of this student');
    window.location = './check_applies.php';
    </script>";

}

?>

<?php
include "../includes/footer.php";
?>