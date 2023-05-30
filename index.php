<?php
include "./includes/header.php";
?>
<header>
    <a href="#" class="logo"><img src="/coursereg/media/images/logo.png" class="nav-logo"></a>
    <ul>
        <li><a href="/course/index.php">Home</a></li>
        <li>
            <div class="dropdown">
                <button class="dropbtn">Login
                </button>
                <div class="dropdown-content">
                    <a href="./students/students_login.php">Student Login</a>
                    <a href="./students/students_signup.php">Student Signup</a>
                    <a href="./account/account_login.php">Accounts Login</a>
                    <a href="./advisor/advisor_login.php">Advisor Login</a>
                    <a href="./registrar/registrar_login.php">Registrar Login</a>
                    <a href="./admin/admin_login.php">Admin Login</a>
                </div>
            </div>
        </li>
    </ul>
</header>
<section class="hero-section">
    <div class="left-hero">
        <img src="./media/student.png" id="left-hero-img" class="left-hero-img">
    </div>
    <div class="right-hero">
        <h2 class="right-hero-title">Stamford University <br> A place for quality education</h2>
    </div>
</section>

<div class="color-design"></div>
<h1 class="g-name">Gallery</h1>
<div class="gallery">
    <div class="img-container">
        <img src="media/Example.jpg" alt="Mountain" data-orginal="media/Examplebig.jpg">
    </div>
    <div class="img-container">
        <img src="media/Example.jpg" alt="Mountain" data-orginal="media/Examplebig.jpg">
    </div>
    <div class="img-container">
        <img src="media/Example.jpg" alt="Mountain" data-orginal="media/Examplebig.jpg">
    </div>
    <div class="img-container">
        <img src="media/Example.jpg" alt="Mountain" data-orginal="media/Examplebig.jpg">
    </div>
</div>
<div class="modal">
    <img src="media/Examplebig.jpg" alt="" class="full-img">
    <p class="caption">mountain</p>
</div>
<?php
include "./includes/footer.php";
?>