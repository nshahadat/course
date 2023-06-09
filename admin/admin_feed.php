<?php
include "../includes/header.php";
include "../includes/nav.php";
include "../includes/db.php";
session_start();
?>

<?php

$sql = "SELECT * FROM offered_courses WHERE approved = 0";
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

?>

<div class="container">

    <div class="btn-section">
        <div class="username-btn">
            <button>
                <?= $_SESSION['username'] ?>
            </button>
        </div>
        <a href="../logout.php">
            <div class="logout-btn">
                <button>logout</button>
            </div>
        </a>
        <div class="adv-btn">
            <a href="./add_advisor.php">
                <button>Add Advisor</button>
            </a>
        </div>
    </div>

    <?php

    if (mysqli_num_rows($result) > 0) {

        ?>

        <table class="table" id="myTable" data-filter-control="true" data-show-search-clear-button="true">
            <tr>
                <th>Course Title</th>
                <th>Course Advisor</th>
                <th>Semester</th>
                <th>Credits</th>
                <th>Approval</th>
            </tr>
            <?php while ($data = mysqli_fetch_assoc($result)) {

                $title = $data['title'];
                $advisor = $data['course_teacher'];
                $semester = $data['semester'];
                $course_credits = $data['course_credits'];
                $id = $data['id'];

                ?>
                <tr>
                    <td>
                        <?= $title ?>
                    </td>
                    <td>
                        <?= $advisor ?>
                    </td>
                    <td>
                        <?= $semester ?>
                    </td>
                    <td>
                        <?= $course_credits ?>
                    </td>
                    <td>
                        <form action="" method="post">
                            <select name="approval" class="select-button4">
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                            <input type="submit" name="savebtn" class="table-btn" value="save">
                            <input type="hidden" name="id" class="table-btn" value="<?= $id ?>">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <div>
            <h1>You have no pending requests</h1>
        </div>
    <?php } ?>
</div>

<?php

if (isset($_POST['savebtn'])) {

    $approval = $_POST['approval'];
    $id = $_POST['id'];

    if ($approval == 1) {

        $sql = "UPDATE offered_courses
            SET approved = $approval
            WHERE id = $id";

        if (mysqli_query($mysqli, $sql)) {

            echo "<script>
            alert('Course approved');
            window.location='./admin_feed.php';
            </script>";

        } else {

            echo "<script>
            alert('Something went wrong');
            window.location='./admin_feed.php';
            </script>";

        }
    } else if ($approval == 0) {

        $del = "DELETE FROM offered_courses WHERE id = $id";

        if (mysqli_query($mysqli, $del)) {

            echo "<script>
            alert('Course denied');
            window.location='./admin_feed.php';
            </script>";

        } else {

            echo "<script>
            alert('Something went wrong');
            window.location='./admin_feed.php';
            </script>";

        }

    }

}

?>

<?php
include "../includes/footer.php";
?>