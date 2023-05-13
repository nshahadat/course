<?php
include "../includes/header.php";
include "../includes/db.php";
session_start();
?>

<?php

$datasql = "SELECT p.*,s.* 
FROM pending_course_requests p
JOIN students s ON p.student_name = s.username
WHERE p.con_from_acc = 1 AND p.con_from_adv = 1 AND p.con_from_reg IS NULL";
$dataresult = mysqli_query($mysqli, $datasql) or die(mysqli_error($mysqli));

?>

<div class="container">
    <div class="btn-section">
        <div class="username-btn"><button>
                <?= $_SESSION['username'] ?>
            </button></div>
        <a href="../index.php">
            <div class="logout-btn"><button>logout</button></div>
        </a>
    </div>
    <hr>

    <table class="table" id="myTable" data-filter-control="true" data-show-search-clear-button="true">
        <tr>
            <th>Student Name</th>
            <th>Student Id</th>
            <th>Student Batch</th>
            <th>Which course to Enroll</th>
            <th>Clearance from Account</th>
        </tr>
        <?php while ($data = mysqli_fetch_assoc($dataresult)) {

            $stuname = $data['username'];
            $courname = $data['course_title'];

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
                    <?= $data['course_title'] ?>
                </td>
                <td>
                    <form action="" method="post">
                        <select name="practical" class="select-button4">
                            <option value=1>Yes</option>
                            <option value=0>No</option>
                        </select>
                        <input type="submit" name="savebtn" class="table-btn" value="save">
                        <input type="hidden" name="stuidhidden" value="<?= $stuname ?>">
                        <input type="hidden" name="couridhidden" value="<?= $courname ?>">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php

if (isset($_POST['savebtn'])) {

    $data = $_POST['practical'];
    $stuhidden = $_POST['stuidhidden'];
    $courhidden = $_POST['couridhidden'];

    $updatedatasql = "UPDATE pending_course_requests 
    SET con_from_reg = $data 
    WHERE student_name = '$stuhidden' AND course_title = '$courhidden'";
    if (mysqli_query($mysqli, $updatedatasql)) {

        $confirmsql = "INSERT INTO 
                        confirmed_courses (course_title, student_name)
                        VALUES ('$courhidden', '$stuhidden')";
        if (mysqli_query($mysqli, $confirmsql)) {

            echo "<script>
            alert('You just changed the payment information of this student');
            window.location = '/course/registrar/check_applies.php';
            </script>";

        } else {

            echo "<script>
            alert('Something went wrong');
            window.location = '/course/registrar/check_applies.php';
            </script>";

        }

    }

}

?>

<?php
include "../includes/footer.php";
?>