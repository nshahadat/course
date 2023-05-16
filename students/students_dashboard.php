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
        <button onclick=gotopayment()>Check Payments</button>
        <button onclick=gotocourse()>Check Courses</button>
    </div>
</div>

<script>
    function gotopayment() {
        window.location = '/course/students/payment_info.php'
    }
    function gotocourse() {
        window.location = '/course/students/check_courses.php'
    }
</script>

<?php
include "../includes/footer.php";
?>