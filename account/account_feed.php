<?php
include "../includes/header.php";
include "../includes/nav.php";
include "../includes/db.php";
session_start();
?>

<div class="container">
    <div class="btn-section">
        <div class="username-btn">
            <button style="min-width:150px !important">
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
            <img src="../media/check.avif" alt="" class="feed-img">
            <button class="extra-btn" onclick=gotoapplies()>Check New Applies</button>
        </div>
        <div class="box">
            <img src="../media/h.jpg" alt="" class="feed-img">
            <button class="extra-btn" onclick=gotohistory()>Confirmation History</button>
        </div>
        <div class="box">
            <img src="../media/account.avif" alt="" class="feed-img">
            <button class="extra-btn" onclick=gotoaccounts()>Check Accounts</button>
        </div>
    </div>
</div>

<script>
    function gotohistory() {
        window.location = './confirmation_history.php'
    }
    function gotoapplies() {
        window.location = './check_applies.php'
    }
    function gotoaccounts() {
        window.location = './check_accounts.php'
    }
</script>

<?php
include "../includes/footer.php";
?>