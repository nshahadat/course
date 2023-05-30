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
        <a href="./students_feed.php">
            <div class="adv-btn">
                <button>Go Back</button>
            </div>
        </a>
    </div>
    <div>
        <button class="extra-btn" onclick=gotopayment()>Check Payments</button>
        <button class="extra-btn" onclick=gotocourse()>Check Courses</button>
    </div>
</div>

<script>
    function gotopayment() {
        window.location = './payment_info.php'
    }
    function gotocourse() {
        window.location = './check_courses.php'
    }
</script>

<?php
include "../includes/footer.php";
?>