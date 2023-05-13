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
        <button onclick=gotocheck()>Check credits</button>
        <button onclick=gotoapplies()>Check New Applies</button>
    </div>
</div>

<script>
    function gotocheck() {
        window.location = '/course/registrar/check_credits.php ?>'
    }
    function gotoapplies() {
        window.location = '/course/registrar/check_applies.php ?>'
    }
</script>

<?php
include "../includes/footer.php";
?>