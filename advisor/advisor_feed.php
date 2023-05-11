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
    <div>
        <button onclick=gotoupload()>Upload New Course</button>
        <button onclick=gotoapplies()>Check New Applies</button>
    </div>
</div>

<script>
    function gotoupload() {
        window.location = '/course/advisor/upload_course.php?advisor=<?= $_SESSION['username'] ?>'
    }
    function gotoapplies() {
        window.location = '/course/advisor/check_applies.php?advisor=<?= $_SESSION['username'] ?>'
    }
</script>

<?php
include "../includes/footer.php";
?>