<?php
include "../includes/header.php";
include "../includes/db.php";
session_start();
?>

<div class="container">
    <div class="btn-section">
        <div class="username-btn">
            <button>
                <?= $_SESSION['username'] ?>
            </button>
        </div>
        <a href="/course/logout.php">
            <div class="logout-btn">
                <button>logout</button>
            </div>
        </a>
    </div>

    <table class="table" id="myTable" data-filter-control="true" data-show-search-clear-button="true">
        <tr>
            <th>Course Title</th>
            <th>Course Advisor</th>
            <th>Semester</th>
            <th>Credits</th>
            <th>Approval</th>
        </tr>
        <?php

        $sql = "SELECT * FROM offered_courses WHERE approved = 0";
        $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

        while ($data = mysqli_fetch_assoc($result)) {

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
            window.location='/course/admin/admin_feed.php';
            </script>";

        } else {

            echo "<script>
            alert('Something went wrong');
            window.location='/course/admin/admin_feed.php';
            </script>";

        }
    } else if ($approval == 0) {

        $del = "DELETE FROM offered_courses WHERE id = $id";

        if (mysqli_query($mysqli, $del)) {

            echo "<script>
            alert('Course denied');
            window.location='/course/admin/admin_feed.php';
            </script>";

        } else {

            echo "<script>
            alert('Something went wrong');
            window.location='/course/admin/admin_feed.php';
            </script>";

        }

    }

}

?>

<?php
include "../includes/footer.php";
?>