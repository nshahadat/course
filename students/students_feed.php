<?php
include "../includes/header.php";
include "../includes/db.php";
session_start();
?>
<div class="btn-section">
    <div class="username-btn"><a href="/course/students/students_dashboard.php"><button>
                <?= $_SESSION['username'] ?>
            </button></a></div>
    <a href="/course/logout.php">
        <div class="logout-btn"><button>logout</button></div>
    </a>
</div>

<?php
$user = $_SESSION['username'];
$advisorsql = "SELECT advisor FROM students WHERE username = '$user'";
$advisorresult = mysqli_query($mysqli, $advisorsql) or die(mysqli_error($mysqli));
$advisordata = mysqli_fetch_assoc($advisorresult);

$advisor = $advisordata['advisor'];

$coursesql = "SELECT * FROM offered_courses WHERE approved = 1 AND course_teacher = '$advisor'";
$resultcourse = mysqli_query($mysqli, $coursesql) or die(mysqli_error($mysqli));
$stuid = $_SESSION['userid'];

?>
<div class="course-wrapper">
    <h1 class="course-title-text">Courses offered by your advisor</h1>
    <div class="courses-card">
        <?php

        if (mysqli_num_rows($resultcourse) < 1) { ?>

            <div>
                <h1>Your Advisor has not offered any course yet.</h1>
            </div>

        <?php } else {

            while ($datacourse = mysqli_fetch_assoc($resultcourse)) { ?>

                <?php

                $course = $datacourse['title'];
                $enrollsql = "SELECT * FROM pending_course_requests WHERE course_title = '$course' AND student_name = '$user'";
                $enrollresult = mysqli_query($mysqli, $enrollsql) or die(mysqli_error($mysqli));


                if (mysqli_num_rows($enrollresult) == 0) { ?>

                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img src="/coursereg/media/images/sample1.png" class="flip-card-img">
                            </div>
                            <div class="flip-card-back">
                                <h1>
                                    <?= $datacourse['title'] ?>
                                </h1>
                                <p>Advisor:
                                    <?= $datacourse['course_teacher'] ?>
                                </p>
                                <p>Semester:
                                    <?= $datacourse['semester'] ?>
                                </p>
                                <p>Credits:
                                    <?= $datacourse['course_credits'] ?>
                                </p>
                                <p>Fees:
                                    <?= $datacourse['course_fees'] ?>
                                </p>
                                <p>
                                <form action="#" method="POST">



                                    <input type="submit" name="submitCourse" value="Enroll" class="enroll-btn">
                                    <input type="hidden" name="coursetitle" value="<?= $datacourse['title'] ?>" class="enroll-btn">


                                </form>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php }
            }
        } ?>
    </div>
</div>

<?php
if (isset($_POST['submitCourse'])) {

    $coursetitle = $_POST['coursetitle'];
    $user = $_SESSION['username'];

    $sql = "INSERT INTO
            pending_course_requests (course_title, student_name)
            VALUES ('$coursetitle', '$user')";
    if (mysqli_query($mysqli, $sql)) {

        echo "<script>
        alert('Request accepted. Wait for confirmation');
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