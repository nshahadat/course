<?php
include "../includes/header.php";
include "../includes/nav.php";
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
        <a href="../logout.php">
            <div class="logout-btn">
                <button>logout</button>
            </div>
        </a>
        <a href="./registrar_feed.php">
            <div class="adv-btn">
                <button>Go Back</button>
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

        $sql = "SELECT * FROM semester";
        $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

        while ($data = mysqli_fetch_assoc($result)) {

            $semester = $data['semester_name'] . " " . $data['semester_year'];

            ?>
            <tr>
                <td>
                    <?= $semester ?>
                </td>
                <td>
                    <?= $data['semester_courses'] ?>
                </td>
                <td>
                    <?= $data['semester_credits'] ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
include "../includes/footer.php";
?>