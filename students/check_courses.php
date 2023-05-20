<?php
include "../includes/header.php";
include "../includes/db.php";
session_start();
?>

<div class="container">

    <div class="btn-section">
        <div class="username-btn"><a href="./students_dashboard.php"><button>
                    <?= $_SESSION['username'] ?>
                </button></a></div>
        <a href="../logout.php">
            <div class="logout-btn"><button>logout</button></div>
        </a>
        <a href="./students_feed.php">
            <div class="adv-btn">
                <button>Go Back</button>
            </div>
        </a>
    </div>

    <?php
    $user = $_SESSION['username'];
    $stusql = "SELECT * FROM confirmed_courses WHERE student_name = '$user'";
    $sturesult = mysqli_query($mysqli, $stusql) or die(mysqli_error($mysqli));

    ?>

    <div class="course-wrapper">
        <h1 class="course-title-text">Your confirm courses</h1>
        <div class="courses-card">
            <?php

            if (mysqli_num_rows($sturesult) < 1) { ?>

                <div>
                    <h1>You have no confirmed courses</h1>
                </div>

            <?php } else {

                while ($studata = mysqli_fetch_assoc($sturesult)) {

                    $coursename = $studata['course_title'];

                    $courseinfosql = "SELECT * FROM offered_courses WHERE approved = 1 AND title = '$coursename'";
                    $resultcourseinfo = mysqli_query($mysqli, $courseinfosql) or die(mysqli_error($mysqli));
                    $resultcoursedata = mysqli_fetch_assoc($resultcourseinfo);

                    ?>

                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img src="/coursereg/media/images/sample1.png" class="flip-card-img">
                            </div>
                            <div class="flip-card-back">
                                <h1>
                                    <?= $resultcoursedata['title'] ?>
                                </h1>
                                <p>Advisor:
                                    <?= $resultcoursedata['course_teacher'] ?>
                                </p>
                                <p>Semester:
                                    <?= $resultcoursedata['semester'] ?>
                                </p>
                                <p>Credits:
                                    <?= $resultcoursedata['course_credits'] ?>
                                </p>
                                <p>Fees:
                                    <?= $resultcoursedata['course_fees'] ?>
                                </p>
                            </div>
                        </div>
                    </div>

                <?php }
            } ?>
        </div>
    </div>
</div>
<?php
$user = $_SESSION['username'];
$stusql = "SELECT * FROM pending_course_requests 
WHERE student_name = '$user' AND (con_from_acc = 0 OR con_from_adv = 0 OR con_from_reg = 0)";
$sturesult = mysqli_query($mysqli, $stusql) or die(mysqli_error($mysqli));

?>
<div class="container">
    <div class="course-wrapper">
        <h1 class="course-title-text">Your pending courses</h1>
        <div class="courses-card">
            <?php

            if (mysqli_num_rows($sturesult) < 1) { ?>

                <div>
                    <h1>You have no pending courses</h1>
                </div>

            <?php } else {

                while ($studata = mysqli_fetch_assoc($sturesult)) {

                    $coursename = $studata['course_title'];

                    $courseinfosql = "SELECT * FROM offered_courses WHERE approved = 1 AND title = '$coursename'";
                    $resultcourseinfo = mysqli_query($mysqli, $courseinfosql) or die(mysqli_error($mysqli));
                    $resultcoursedata = mysqli_fetch_assoc($resultcourseinfo);

                    ?>

                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img src="/coursereg/media/images/sample1.png" class="flip-card-img">
                            </div>
                            <div class="flip-card-back">
                                <h1>
                                    <?= $resultcoursedata['title'] ?>
                                </h1>
                                <p>Advisor:
                                    <?= $resultcoursedata['course_teacher'] ?>
                                </p>
                                <p>Semester:
                                    <?= $resultcoursedata['semester'] ?>
                                </p>
                                <p>Credits:
                                    <?= $resultcoursedata['course_credits'] ?>
                                </p>
                                <p>Fees:
                                    <?= $resultcoursedata['course_fees'] ?>
                                </p>
                            </div>
                        </div>
                    </div>

                <?php }
            } ?>
        </div>
    </div>
</div>


<?php
include "../includes/footer.php";
?>