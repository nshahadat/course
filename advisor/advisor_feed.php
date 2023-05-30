<?php
include "../includes/header.php";
include "../includes/nav.php";
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
        <a href="../logout.php">
            <div class="logout-btn">
                <button>logout</button>
            </div>
        </a>
    </div>
    <div>
        <button class="extra-btn" onclick=gotoupload()>Upload New Course</button>
        <button class="extra-btn" onclick=gotoapplies()>Check New Applies</button>
        <button class="extra-btn" onclick=gotoenroll()>Check Enroll Students</button>
    </div>
</div>

<script>
    function gotoupload() {
        window.location = './upload_course.php?advisor=<?= $_SESSION['username'] ?>'
    }
    function gotoapplies() {
        window.location = './check_applies.php?advisor=<?= $_SESSION['username'] ?>'
    }
    function gotoenroll() {
        window.location = './enroll_list.php?advisor=<?= $_SESSION['username'] ?>'
    }
</script>

<?php
include "../includes/footer.php";
?>