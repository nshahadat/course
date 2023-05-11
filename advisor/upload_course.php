<?php
include "../includes/header.php";
include "../includes/db.php";
session_start();
?>

<?php

$coursesql = "SELECT title FROM all_courses";
$courseresult = mysqli_query($mysqli, $coursesql) or die(mysqli_error($mysqli));

?>
<div class="container">

    <div class="btn-section">
        <div class="username-btn">
            <button onclick="gotoadmindash()">
                <?= $_SESSION['username'] ?>
            </button>
        </div>
        <a href="/course/logout.php">
            <div class="logout-btn">
                <button>logout</button>
            </div>
        </a>
    </div>

    <form class="form-1" method="post">

        <h2>New Course Upload</h2>

        <label for="cour_name">Course Name</label>
        <select name="course_name" id="selectField">
            <option disabled selected>Choose</option>
            <?php while ($coursedata = mysqli_fetch_assoc($courseresult)) { ?>
                <option value="<?= $coursedata['title'] ?>">
                    <?= $coursedata['title'] ?>
                </option>
            <?php } ?>
        </select>

        <label for="cour_name">Semester</label>
        <select name="semester" id="selectField">
            <option disabled selected>Choose</option>
            <option value="Summer">Summer</option>
            <option value="Spring">Spring</option>
        </select>

        <label for="cour_name">Course Credits</label>
        <input type="number" name="course_credit" class="input_field" required />

        <label for="assigned_teacher">Course Fees</label>
        <input type="number" name="cour_fee" class="input_field" required />

        <input type="submit" name="submitbtn" value="Upload" class="login-btn1">

    </form>

</div>

<?php

if (isset($_POST['submitbtn'])) {

    $coursename = $_POST['course_name'];
    $semester = $_POST['semester'];
    $credit = $_POST['course_credit'];
    $fees = $_POST['cour_fee'];
    $advisor = $_SESSION['username'];

    $getcodesql = "SELECT code FROM all_courses WHERE title = '$coursename'";
    $getcoderesult = mysqli_query($mysqli, $getcodesql) or die(mysqli_error($mysqli));
    $getcodedata = mysqli_fetch_assoc($getcoderesult);

    $insertcoursesql = "INSERT INTO   
                    offered_courses (title, advisor, semester, course_credits, course_fees approved)
                    VALUES ('$coursename', '$advisor', '$semester', '$fees', '$credit', 0)";

    echo $insertcoursesql;

    if (mysqli_query($mysqli, $insertcoursesql)) {

        echo "<script>
        alert('Course uploaded succesfully');
        window.location='/course/advisor/upload_course.php'</script>";

    } else {

        echo "<script>
        alert('Something went wrong');
        window.location='/course/advisor/upload_course.php'</script>";

    }
}

?>

<?php
include "../includes/footer.php";
?>