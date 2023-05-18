<?php
include "../includes/header.php";
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
        <a href="/course/logout.php">
            <div class="logout-btn">
                <button>logout</button>
            </div>
        </a>
    </div>
    <div>
        <button class="extra-btn" onclick=gotoapplies()>Check New Applies</button>
        <button class="extra-btn" onclick=gotohistory()>Confirmation History</button>
        <button class="extra-btn" onclick=gotoaccounts()>Check Accounts</button>
    </div>
</div>

<script>
    function gotohistory() {
        window.location = '/course/account/confirmation_history.php'
    }
    function gotoapplies() {
        window.location = '/course/account/check_applies.php'
    }
    function gotoaccounts() {
        window.location = '/course/account/check_accounts.php'
    }
</script>

<?php
include "../includes/footer.php";
?>