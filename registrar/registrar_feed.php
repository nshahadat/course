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
        <a href="../logout.php">
            <div class="logout-btn">
                <button>logout</button>
            </div>
        </a>
    </div>
    <div>
        <button class="extra-btn" onclick=gotocheck()>Check credits</button>
        <button class="extra-btn" onclick=gotoapplies()>Check New Applies</button>
    </div>
</div>

<script>
    function gotocheck() {
        window.location = './check_credits.php'
    }
    function gotoapplies() {
        window.location = './check_applies.php'
    }
</script>

<?php
include "../includes/footer.php";
?>