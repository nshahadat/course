<?php
include "../includes/header.php";
include "../includes/db.php";
session_start();
?>

<div class="container">

    <div class="btn-section">
        <div class="username-btn"><a href="/coursereg/students/studashboard.php"><button>
                    <?= $_SESSION['username'] ?>
                </button></a></div>
        <a href="/course/logout.php">
            <div class="logout-btn"><button>logout</button></div>
        </a>
        <a href="/course/students/students_feed.php">
            <div class="adv-btn">
                <button>Go Back</button>
            </div>
        </a>
    </div>

    <?php
    $user = $_SESSION['username'];
    $stupaysql = "SELECT p.*, c.*
                FROM payment p
                JOIN offered_courses c ON p.payment_course = c.title 
                WHERE p.student_name = '$user' AND p.payment_complete IS NULL";
    $stupayresult = mysqli_query($mysqli, $stupaysql) or die(mysqli_error($mysqli));

    ?>
    <div class="course-wrapper" style="width:auto !important;">
        <h1 class="course-title-text">Your payment status</h1>
        <div class="courses-card">
            <?php

            if (mysqli_num_rows($stupayresult) < 1) { ?>

                <div>
                    <h1>ALL of your payments are completed.</h1>
                </div>

            <?php } else { ?>

                <table class="table" id="myTable" data-filter-control="true" data-show-search-clear-button="true">
                    <tr>
                        <th>Student Name</th>
                        <th>Course Name</th>
                        <th>Course Fees</th>
                        <th>Payment</th>
                    </tr>
                    <?php while ($stupaydata = mysqli_fetch_assoc($stupayresult)) { ?>
                        <tr>
                            <td>
                                <?= $stupaydata['student_name'] ?>
                            </td>
                            <td>
                                <?= $stupaydata['payment_course'] ?>
                            </td>
                            <td>
                                <?= $stupaydata['course_fees'] ?>
                            </td>
                            <td>
                                <form action="#" method="POST">
                                    <input type="submit" name="savebtn" class="table-btn" value="Payment">
                                    <input type="hidden" name="student" class="table-btn"
                                        value="<?= $stupaydata['student_name'] ?>">
                                    <input type="hidden" name="course" class="table-btn"
                                        value="<?= $stupaydata['payment_course'] ?>">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        </div>
    </div>

</div>

<?php
if (isset($_POST['savebtn'])) {

    $student = $_POST['student'];
    $course = $_POST['course'];

    $sql = "UPDATE payment
            SET payment_complete = 1
            WHERE student_name = '$student' AND payment_course = '$course'";
    if (mysqli_query($mysqli, $sql)) {

        echo "<script>
        alert('Payment completed for this course');
        window.location ='/course/students/students_feed.php';
        </script>";

    } else {

        echo "<script>
        alert('Something went wrong');
        window.location ='/course/students/students_feed.php';
        </script>";

    }

}
?>

<?php
include "../includes/footer.php";
?>