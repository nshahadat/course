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
    <div class="feed-container">
       <div class="box">
       <img src="../media/up.png" alt=""class="feed-img">
       <button class="extra-btn" onclick=gotoapplies()>Upload New Course</button></div>
       <div class="box">
       <img src="../media/check.avif" alt=""class="feed-img"> 
       <button class="extra-btn" onclick=gotohistory()>Check New Applies</button></div>
       <div class="box">
       <img src="../media/enroll.jpg" alt=""class="feed-img">
       <button class="extra-btn" onclick=gotoaccounts()>Check Enroll Students</button></div>
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