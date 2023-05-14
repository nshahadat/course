<?php
include "../includes/header.php";
include "../includes/db.php";
session_start();
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

    <table class="table" id="myTable" data-filter-control="true" data-show-search-clear-button="true">
        <tr>
            <th>Semester</th>
            <th>Total Course Approved</th>
            <th>Total Credits</th>
        </tr>
        <?php

        $sql = "SELECT p.*, c.*, t.total_credits, t.total_course
                FROM pending_course_requests p
                JOIN offered_courses c ON p.course_title = c.title
                JOIN (
                SELECT oc.semester, SUM(oc.course_credits) AS total_credits, COUNT(*) AS total_course
                FROM offered_courses oc
                GROUP BY oc.semester
                ) t ON c.semester = t.semester
                WHERE
                p.con_from_acc = 1
                ORDER BY
                c.semester;    
                ";
        $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

        while ($data = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td>
                    <?= $data['semester'] ?>
                </td>
                <td>
                    <?= $data['total_course'] ?>
                </td>
                <td>
                    <?= $data['total_credits'] ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
include "../includes/footer.php";
?>