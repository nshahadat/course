<?php
include "../includes/header.php";
include "../includes/nav.php";
include "../includes/db.php";
session_start();
?>

<div class="container">
    <div class="btn-section">
        <div class="username-btn">
            <button onclick="gotoadmindash()" style="min-width:150px !important">
                <?= $_SESSION['username'] ?>
            </button>
        </div>
        <a href="../logout.php">
            <div class="logout-btn">
                <button>logout</button>
            </div>
        </a>
        <a href="./account_feed.php">
            <div class="adv-btn">
                <button style="right:35vw !important">Go Back</button>
            </div>
        </a>
    </div>

    <!-- <form class="form-1" method="post">

            <label for="sem">Semester</label>
            <select name="sem" id="selectField">
                <option value="Summer">Summer</option>
                <option value="Spring">Spring</option>
            </select>

            <label for="year">Year</label>
            <select name="year" id="selectField">
                <option disabled selected>Choose</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
            </select>

            <input type="submit" name="submitbtn" value="Search" class="login-btn1">
        </form> -->

    <table class="table" id="myTable" data-filter-control="true" data-show-search-clear-button="true">
        <tr>
            <th>Semester</th>
            <th>Total Course Approved</th>
            <th>Total Amount</th>
        </tr>
        <?php

        $sql = "SELECT p.*, c.*, SUM(course_fees) AS total_fees, COUNT(*) AS total_course
                FROM pending_course_requests p
                JOIN offered_courses c ON p.course_title = c.title
                WHERE p.con_from_acc = 1 ORDER BY c.semester";
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
                    <?= $data['total_fees'] ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
include "../includes/footer.php";
?>